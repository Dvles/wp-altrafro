<?php
/**
 * Register ACF field groups
 *
 * @package altr
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF fields for posts
 */
function altr_register_acf_fields() {
    // Check if ACF is active
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    acf_add_local_field_group([
        'key' => 'group_post_meta',
        'title' => 'Post Meta',
        'fields' => [
            [
                'key' => 'field_is_featured_blog',
                'label' => 'Featured in Blog',
                'name' => 'is_featured_blog',
                'type' => 'true_false',
                'instructions' => 'Display this post as a featured (default) card on mobile blog view',
                'required' => 0,
                'default_value' => 0,
                'ui' => 1, 
                'ui_on_text' => 'Featured',
                'ui_off_text' => 'Regular',
            ],
            [
                'key' => 'field_artist',
                'label' => 'Artist',
                'name' => 'artist',
                'type' => 'text',
                'instructions' => 'Enter the artist name for this post',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'e.g., Odunsi Jr Fabrice-Prince',
                'maxlength' => 100,
            ],
            [
            'key' => 'field_series_number',
            'label' => 'Series Number',
            'name' => 'series_number',
            'type' => 'number',
            'instructions' => 'Episode number (auto-generated for CBD series)',
            'required' => 0,
            'default_value' => '',
            'placeholder' => 'e.g., 44',
            'min' => 1,
            'max' => 999,
            ],
            [
                'key' => 'field_subtitle',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'instructions' => 'Enter the subtitle (used for featured posts and displays)',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'e.g., Quand l\'émotion prend une forme universelle',
                'maxlength' => 150,
            ],
            [
                'key' => 'field_series_description',
                'label' => 'Series Description',
                'name' => 'series_description',
                'type' => 'text',
                'instructions' => 'Enter the series description',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'e.g., Creative by design ; exploration artistique approfondie',
                'maxlength' => 200,
            ],
            [
                'key' => 'field_hero_media_flexible',
                'label' => 'Hero Media',
                'name' => 'hero_media',
                'type' => 'flexible_content',
                'instructions' => 'Choose an image or a video for the hero section.',
                'layouts' => [
                    'layout_hero_image' => [
                        'key' => 'layout_hero_image',
                        'name' => 'image',
                        'label' => 'Image',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_hero_image',
                                'label' => 'Hero Image',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size'  => 'large',
                                'library'       => 'all',
                            ],
                        ],
                    ],
                    'layout_hero_video' => [
                        'key' => 'layout_hero_video',
                        'name' => 'video',
                        'label' => 'Video',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_hero_video',
                                'label' => 'Hero Video (.mp4)',
                                'name' => 'video',
                                'type' => 'file',
                                'return_format' => 'array',
                                'library' => 'all',
                                'mime_types' => 'mp4',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ]);
}
add_action('acf/init', 'altr_register_acf_fields');


/**
 * Helper function to check if post is featured in blog
 */
function altr_is_featured_blog($post_id = null) {
    if (!function_exists('get_field')) {
        return false;
    }
    
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return (bool) get_field('is_featured_blog', $post_id);
}



/**
 * Helper function to get artist name
 */
function altr_get_artist($post_id = null) {
    if (!function_exists('get_field')) {
        return '';
    }
    
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return get_field('artist', $post_id) ?: '';
}

/**
 * Helper function to get subtitle
 */
function altr_get_subtitle($post_id = null) {
    if (!function_exists('get_field')) {
        return '';
    }
    
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $subtitle = get_field('subtitle', $post_id) ?: '';
    
    // Add "révélé en 30 questions" for 30? series
    $title = get_the_title($post_id);
    if ($subtitle && strpos($title, '30?') !== false) {
        $subtitle .= ', révélé en 30 questions';
    }
    
    return $subtitle;
}

/**
 * Helper function to get series description
 */
function altr_get_series_description($post_id = null) {
    if (!function_exists('get_field')) {
        return '';
    }
    
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return get_field('series_description', $post_id) ?: '';
}

/**
 * Display artist name
 */
function altr_the_artist($post_id = null) {
    $artist = altr_get_artist($post_id);
    if ($artist) {
        echo esc_html($artist);
    }
}



/**
 * Display series description
 */
function altr_the_series_description($post_id = null) {
    $series_desc = altr_get_series_description($post_id);
    if ($series_desc) {
        echo esc_html($series_desc);
    }
}

/**
 * Get next CBD series number
 * Finds the highest CBD number and returns next one
 *
 * @return int Next CBD number
 */
function altr_get_next_cbd_number() {
    global $wpdb;
    
    // Query to find highest CBD number
    $query = "
        SELECT MAX(CAST(pm.meta_value AS UNSIGNED)) as max_number
        FROM {$wpdb->postmeta} pm
        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = 'series_number'
        AND p.post_type = 'post'
        AND p.post_status IN ('publish', 'draft', 'pending')
        AND p.post_title LIKE 'CBD%'
    ";
    
    $max_number = $wpdb->get_var($query);
    
    // Start at 44 if no CBD posts exist
    return $max_number ? intval($max_number) + 1 : 44;
}

/**
 * Get series number for a post
 *
 * @param int $post_id Optional post ID
 * @return int|null Series number or null
 */
function altr_get_series_number($post_id = null) {
    if (!function_exists('get_field')) {
        return null;
    }
    
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $number = get_field('series_number', $post_id);
    return $number ? intval($number) : null;
}

/**
 * Display series number in superscript
 *
 * @param int $post_id Optional post ID
 */
function altr_the_series_number($post_id = null) {
    $number = altr_get_series_number($post_id);
    if ($number) {
        echo '<sup>' . esc_html($number) . '</sup>';
    }
}