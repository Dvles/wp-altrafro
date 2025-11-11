<?php
/**
 * Duplicate posts, pages, and custom post types
 *
 * Adds "Duplicate" action links to the admin interface
 * and handles cloning of content with all metadata
 *
 * @package altr
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add duplicate link to post/page action links
 *
 * @param array $actions Current action links
 * @param WP_Post $post Current post object
 * @return array Modified action links
 */
function altr_duplicate_post_link($actions, $post) {
    // Check if user has permission to edit posts
    if (!current_user_can('edit_posts')) {
        return $actions;
    }
    
    // Get the post type object
    $post_type_object = get_post_type_object($post->post_type);
    
    // Check if post type supports duplication
    if (!$post_type_object || !$post_type_object->show_ui) {
        return $actions;
    }
    
    // Create duplicate URL with nonce for security
    $duplicate_url = wp_nonce_url(
        add_query_arg([
            'action' => 'altr_duplicate_post',
            'post' => $post->ID,
        ], admin_url('admin.php')),
        'altr_duplicate_' . $post->ID,
        'altr_duplicate_nonce'
    );
    
    // Add the duplicate link
    $actions['duplicate'] = sprintf(
        '<a href="%s" title="%s">%s</a>',
        esc_url($duplicate_url),
        esc_attr__('Duplicate this item', ALTR_TEXT_DOMAIN),
        __('Duplicate', ALTR_TEXT_DOMAIN)
    );
    
    return $actions;
}
add_filter('post_row_actions', 'altr_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'altr_duplicate_post_link', 10, 2);

/**
 * Handle the duplication request
 */
function altr_duplicate_post_handler() {
    // Verify we have the right action
    if (!isset($_GET['action']) || $_GET['action'] !== 'altr_duplicate_post') {
        return;
    }
    
    // Get post ID
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    
    if (!$post_id) {
        wp_die(__('No post to duplicate has been provided!', ALTR_TEXT_DOMAIN));
    }
    
    // Verify nonce
    if (!isset($_GET['altr_duplicate_nonce']) || 
        !wp_verify_nonce($_GET['altr_duplicate_nonce'], 'altr_duplicate_' . $post_id)) {
        wp_die(__('Security check failed!', ALTR_TEXT_DOMAIN));
    }
    
    // Get the original post
    $post = get_post($post_id);
    
    if (!$post) {
        wp_die(__('Post not found!', ALTR_TEXT_DOMAIN));
    }
    
    // Check permissions
    $post_type_object = get_post_type_object($post->post_type);
    if (!current_user_can($post_type_object->cap->edit_posts)) {
        wp_die(__('You do not have permission to duplicate this post.', ALTR_TEXT_DOMAIN));
    }
    
    // Duplicate the post
    $new_post_id = altr_duplicate_post($post);
    
    if (!$new_post_id || is_wp_error($new_post_id)) {
        wp_die(__('Post duplication failed!', ALTR_TEXT_DOMAIN));
    }
    
    // Redirect to edit screen of new post
    wp_safe_redirect(
        add_query_arg(
            'message',
            99, // Custom message number
            admin_url('post.php?action=edit&post=' . $new_post_id)
        )
    );
    exit;
}
add_action('admin_action_altr_duplicate_post', 'altr_duplicate_post_handler');

/**
 * Duplicate a post with all its metadata
 *
 * @param WP_Post $post Post object to duplicate
 * @param string $status Optional. Post status for the duplicate (default: 'draft')
 * @return int|WP_Error New post ID or WP_Error on failure
 */
function altr_duplicate_post($post, $status = 'draft') {
    // Prepare the new post data
    $new_post_data = [
        'post_title'     => $post->post_title . ' (Copy)',
        'post_content'   => $post->post_content,
        'post_excerpt'   => $post->post_excerpt,
        'post_status'    => $status,
        'post_type'      => $post->post_type,
        'post_author'    => get_current_user_id(),
        'post_parent'    => $post->post_parent,
        'post_password'  => $post->post_password,
        'menu_order'     => $post->menu_order,
        'comment_status' => $post->comment_status,
        'ping_status'    => $post->ping_status,
    ];
    
    // Insert the new post
    $new_post_id = wp_insert_post($new_post_data);
    
    if (is_wp_error($new_post_id)) {
        return $new_post_id;
    }
    
    // Duplicate all post meta
    $post_meta = get_post_meta($post->ID);
    if ($post_meta) {
        foreach ($post_meta as $meta_key => $meta_values) {
            // Skip certain meta keys that shouldn't be duplicated
            if (in_array($meta_key, ['_edit_lock', '_edit_last'])) {
                continue;
            }
            
            foreach ($meta_values as $meta_value) {
                add_post_meta($new_post_id, $meta_key, maybe_unserialize($meta_value));
            }
        }
    }
    
    // Duplicate all taxonomies (categories, tags, custom taxonomies)
    $taxonomies = get_object_taxonomies($post->post_type);
    if ($taxonomies) {
        foreach ($taxonomies as $taxonomy) {
            $terms = wp_get_object_terms($post->ID, $taxonomy, ['fields' => 'ids']);
            if (!is_wp_error($terms) && !empty($terms)) {
                wp_set_object_terms($new_post_id, $terms, $taxonomy);
            }
        }
    }
    
    return $new_post_id;
}

/**
 * Add custom admin notice for duplicated posts
 *
 * @param array $messages Current messages
 * @return array Modified messages
 */
function altr_duplicate_post_messages($messages) {
    $messages['post'][99] = __('Post duplicated successfully!', ALTR_TEXT_DOMAIN);
    $messages['page'][99] = __('Page duplicated successfully!', ALTR_TEXT_DOMAIN);
    
    return $messages;
}
add_filter('post_updated_messages', 'altr_duplicate_post_messages');

/**
 * Add duplicate functionality to admin bar (quick access)
 *
 * @param WP_Admin_Bar $wp_admin_bar Admin bar object
 */
function altr_duplicate_admin_bar_link($wp_admin_bar) {
    // Only show on single post/page edit screens
    if (!is_admin() || !function_exists('get_current_screen')) {
        return;
    }
    
    $screen = get_current_screen();
    if (!$screen || $screen->base !== 'post') {
        return;
    }
    
    global $post;
    if (!$post) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_posts')) {
        return;
    }
    
    // Create duplicate URL
    $duplicate_url = wp_nonce_url(
        add_query_arg([
            'action' => 'altr_duplicate_post',
            'post' => $post->ID,
        ], admin_url('admin.php')),
        'altr_duplicate_' . $post->ID,
        'altr_duplicate_nonce'
    );
    
    // Add admin bar item
    $wp_admin_bar->add_node([
        'id'    => 'duplicate_post',
        'title' => __('Duplicate', ALTR_TEXT_DOMAIN),
        'href'  => esc_url($duplicate_url),
        'meta'  => [
            'title' => __('Duplicate this item', ALTR_TEXT_DOMAIN),
        ],
    ]);
}
add_action('admin_bar_menu', 'altr_duplicate_admin_bar_link', 90);