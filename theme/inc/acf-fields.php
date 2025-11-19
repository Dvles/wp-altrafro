<?php

/**
 * Register ACF field groups
 *
 * @package altr
 */
if (!defined('ABSPATH')) {
    exit;
}

function altr_register_acf_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    /**
     * Post Meta
     */
    acf_add_local_field_group([
        'key' => 'group_post_meta',
        'title' => 'Post Meta',
        'fields' => [
            [
                'key' => 'field_is_featured_blog',
                'label' => 'Featured in Blog',
                'name' => 'is_featured_blog',
                'type' => 'true_false',
                'instructions' => 'Display as featured card on mobile',
                'ui' => 1,
            ],
            [
                'key' => 'field_artist',
                'label' => 'Artist',
                'name' => 'artist',
                'type' => 'text',
                'placeholder' => 'e.g., Odunsi Jr Fabrice-Prince',
            ],
            [
                'key' => 'field_series_number',
                'label' => 'Series Number',
                'name' => 'series_number',
                'type' => 'number',
                'placeholder' => 'e.g., 44',
            ],
            [
                'key' => 'field_subtitle',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'placeholder' => 'e.g., Quand l\'émotion prend une forme universelle',
            ],
            [
                'key' => 'field_series_description',
                'label' => 'Series Description',
                'name' => 'series_description',
                'type' => 'text',
                'placeholder' => 'e.g., Creative by design',
            ],
        ],
        'location' => [
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => 'post'],
            ],
        ],
        'menu_order' => 0,
        'position' => 'side',
    ]);

    /**
     * Hero Media
     */
    acf_add_local_field_group([
        'key' => 'group_hero_media',
        'title' => 'Hero Media',
        'fields' => [
            [
                'key' => 'field_hero_image',
                'label' => 'Hero Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => 'post'],
            ],
        ],
        'menu_order' => 1,
        'position' => 'normal',
    ]);

    /**
     * Post Content (Tabbed)
     */
    acf_add_local_field_group([
        'key' => 'group_post_content',
        'title' => 'Post Content',
        'fields' => [
            // TAB: Intro
            [
                'key' => 'field_tab_intro',
                'label' => 'Intro',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_intro_text',
                'label' => 'Intro Text',
                'name' => 'intro_text',
                'type' => 'textarea',
                'instructions' => 'Opening paragraph (displays larger)',
                'required' => 1,
                'rows' => 6,
            ],
            // TAB: Content
            [
                'key' => 'field_tab_content',
                'label' => 'Content',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_main_content',
                'label' => 'Main Content',
                'name' => 'main_content',
                'type' => 'wysiwyg',
                'instructions' => 'Main article content',
                'required' => 1,
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            ],
            // TAB: Outro
            [
                'key' => 'field_tab_outro',
                'label' => 'Outro',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_outro_text',
                'label' => 'Outro Text',
                'name' => 'outro_text',
                'type' => 'textarea',
                'instructions' => 'Closing paragraph',
                'required' => 1,
                'rows' => 6,
            ],
        ],
        'location' => [
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => 'post'],
            ],
        ],
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
    ]);
}
add_action('acf/init', 'altr_register_acf_fields');

/**
 * ===========================================
 * IMAGE CREDITS IN MEDIA MODAL
 * ===========================================
 */

/**
 * Add credit fields to media modal (at the top)
 */
add_filter('attachment_fields_to_edit', function($form_fields, $post) {
    if (strpos($post->post_mime_type, 'image') === false) {
        return $form_fields;
    }

    // Create credit fields first
    $credit_fields = [
        'altr_photographer' => [
            'label' => '⚠️ Photographer / Artist *',
            'input' => 'text',
            'value' => get_post_meta($post->ID, '_altr_photographer', true),
            'helps' => 'REQUIRED - image won\'t display without credit',
        ],
        'altr_artwork_title' => [
            'label' => 'Artwork Title',
            'input' => 'text',
            'value' => get_post_meta($post->ID, '_altr_artwork_title', true),
        ],
        'altr_year' => [
            'label' => 'Year',
            'input' => 'text',
            'value' => get_post_meta($post->ID, '_altr_year', true),
        ],
        'altr_source' => [
            'label' => 'Source URL',
            'input' => 'text',
            'value' => get_post_meta($post->ID, '_altr_source', true),
        ],
    ];

    // Merge credit fields BEFORE other fields
    return array_merge($credit_fields, $form_fields);
}, 10, 2);
/**
 * Save custom attachment fields
 */
add_filter('attachment_fields_to_save', function($post, $attachment) {
    if (isset($attachment['altr_photographer'])) {
        update_post_meta($post['ID'], '_altr_photographer', sanitize_text_field($attachment['altr_photographer']));
    }
    if (isset($attachment['altr_artwork_title'])) {
        update_post_meta($post['ID'], '_altr_artwork_title', sanitize_text_field($attachment['altr_artwork_title']));
    }
    if (isset($attachment['altr_year'])) {
        update_post_meta($post['ID'], '_altr_year', sanitize_text_field($attachment['altr_year']));
    }
    if (isset($attachment['altr_source'])) {
        update_post_meta($post['ID'], '_altr_source', esc_url_raw($attachment['altr_source']));
    }
    return $post;
}, 10, 2);

/**
 * Get formatted image credit
 */
function altr_get_image_credit($attachment_id) {
    $photographer = get_post_meta($attachment_id, '_altr_photographer', true);
    
    if (!$photographer) {
        return '';
    }
    
    $title = get_post_meta($attachment_id, '_altr_artwork_title', true);
    $year = get_post_meta($attachment_id, '_altr_year', true);
    $source = get_post_meta($attachment_id, '_altr_source', true);
    
    $parts = [];
    
    if ($title) {
        $parts[] = '<em>' . esc_html($title) . '</em>';
    }
    
    $parts[] = '© ' . esc_html($photographer);
    
    if ($year) {
        $parts[] = esc_html($year);
    }
    
    $credit = implode(', ', $parts);
    
    if ($source) {
        $credit = '<a href="' . esc_url($source) . '" target="_blank" rel="noopener">' . $credit . '</a>';
    }
    
    return $credit;
}

/**
 * Filter images in content - hide if no credit
 */
add_filter('the_content', function($content) {
    if (empty($content)) {
        return $content;
    }
    
    // Find all images in content
    $content = preg_replace_callback(
        '/<img[^>]+>/i',
        function($matches) {
            $img = $matches[0];
            
            // Extract attachment ID from class
            if (preg_match('/wp-image-(\d+)/', $img, $id_match)) {
                $attachment_id = $id_match[1];
                $credit = altr_get_image_credit($attachment_id);
                
                // If no credit, hide image
                if (!$credit) {
                    return '<!-- Image hidden: missing photographer credit -->';
                }
                
                // Wrap image with figure and caption
                return '<figure class="wp-block-image">' . $img . 
                       '<figcaption class="text-[11px] font-mono mt-2 text-right">' . $credit . '</figcaption></figure>';
            }
            
            return $img;
        },
        $content
    );
    
    return $content;
}, 20);

/**
 * Admin notice for missing credits
 */
add_action('admin_notices', function() {
    global $pagenow, $post;
    
    if ($pagenow !== 'post.php' || !$post || $post->post_type !== 'post') {
        return;
    }
    
    $main_content = get_field('main_content', $post->ID);
    if (empty($main_content)) {
        return;
    }
    
    // Count images without credits
    $missing = 0;
    preg_match_all('/wp-image-(\d+)/', $main_content, $matches);
    
    if (!empty($matches[1])) {
        foreach ($matches[1] as $attachment_id) {
            if (!get_post_meta($attachment_id, '_altr_photographer', true)) {
                $missing++;
            }
        }
    }
    
    if ($missing > 0) {
        echo '<div class="notice notice-warning"><p>';
        echo '<strong>⚠️ ' . $missing . ' image(s) missing photographer credits.</strong> ';
        echo 'Images without credits will be hidden on the frontend.';
        echo '</p></div>';
    }
});

/**
 * Filter ACF WYSIWYG content - hide images without credits
 */
add_filter('acf/format_value/type=wysiwyg', function($value, $post_id, $field) {
    if (empty($value)) {
        return $value;
    }
    
    // Find all images in content
    $value = preg_replace_callback(
        '/<img[^>]+>/i',
        function($matches) {
            $img = $matches[0];
            
            // Extract attachment ID from class
            if (preg_match('/wp-image-(\d+)/', $img, $id_match)) {
                $attachment_id = $id_match[1];
                $credit = altr_get_image_credit($attachment_id);
                
                // If no credit, hide image
                if (!$credit) {
                    return '<!-- Image hidden: missing photographer credit -->';
                }
                
                // Wrap image with figure and caption
                return '<figure class="wp-block-image">' . $img . 
                       '<figcaption class="text-[11px] font-mono mt-2 text-right">' . $credit . '</figcaption></figure>';
            }
            
            return $img;
        },
        $value
    );
    
    return $value;
}, 20, 3);