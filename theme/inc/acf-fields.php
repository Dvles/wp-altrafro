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
 * Register ACF fields for posts & images
 */
function altr_register_acf_fields()
{
    // Check if ACF is active
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    /**
     * Register ACF fields for posts
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


    /**
     * Register ACF fields for image credits (attachments)
     */

    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name'            => 'image-with-credit',
            'title'           => 'Image with Credit',
            'description'     => 'Image block with required photographer credit',
            'render_template' => 'template-parts/blocks/image-credit.php',
            'category'        => 'media',
            'icon'            => 'format-image',
            'mode'            => 'edit',
            'supports'        => [
                'align'  => ['wide', 'full'],
                'anchor' => true,
            ],
        ]);
    }

    /**
     * Register fields FOR the image-with-credit block
     */
    acf_add_local_field_group([
        'key' => 'group_image_credit_block',
        'title' => 'Image with Credit Block',
        'fields' => [
            [
                'key' => 'field_block_image',
                'label' => 'Image',
                'name' => 'block_image',
                'type' => 'image',
                'required' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_block_photographer',
                'label' => 'Photographer / Artist',
                'name' => 'block_photographer',
                'type' => 'text',
                'required' => 1,
                'placeholder' => 'e.g., Aisha Koné',
            ],
            [
                'key' => 'field_block_artwork_title',
                'label' => 'Artwork Title',
                'name' => 'block_artwork_title',
                'type' => 'text',
                'required' => 0,
                'placeholder' => 'e.g., Sunset in Dakar',
            ],
            [
                'key' => 'field_block_year',
                'label' => 'Year',
                'name' => 'block_year',
                'type' => 'text',
                'required' => 0,
                'placeholder' => 'e.g., 2024',
            ],
            [
                'key' => 'field_block_source',
                'label' => 'Source / Website',
                'name' => 'block_source',
                'type' => 'url',
                'required' => 0,
                'placeholder' => 'https://artist-website.com',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/image-with-credit',
                ],
            ],
        ],
    ]);


    acf_add_local_field_group([
        'key' => 'group_image_credits',
        'title' => 'Image Credits',
        'fields' => [
            [
                'key' => 'field_credit_photographer',
                'label' => 'Photographer / Artist',
                'name' => 'credit_photographer',
                'type' => 'text',
                'instructions' => 'Credit the creator (required for editorial use)',
                'required' => 1,
                'placeholder' => 'e.g., Aisha Koné',
            ],
            [
                'key' => 'field_credit_artwork_title',
                'label' => 'Artwork Title',
                'name' => 'credit_artwork_title',
                'type' => 'text',
                'instructions' => 'Name of the artwork or photograph',
                'required' => 0,
                'placeholder' => 'e.g., Sunset in Dakar',
            ],
            [
                'key' => 'field_credit_year',
                'label' => 'Year',
                'name' => 'credit_year',
                'type' => 'text',
                'instructions' => 'Year created',
                'required' => 0,
                'placeholder' => 'e.g., 2024',
            ],
            [
                'key' => 'field_credit_source',
                'label' => 'Source / Website',
                'name' => 'credit_source',
                'type' => 'url',
                'instructions' => 'Link to artist website or original source',
                'required' => 0,
                'placeholder' => 'https://artist-website.com',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'attachment',
                    'operator' => '==',
                    'value' => 'image',
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
 * Get formatted image credit
 */
function altr_get_image_credit($attachment_id)
{
    if (!function_exists('get_field')) {
        return '';
    }

    $photographer = get_field('credit_photographer', $attachment_id);
    if (!$photographer) {
        return '';
    }

    $title = get_field('credit_artwork_title', $attachment_id);
    $year = get_field('credit_year', $attachment_id);
    $source = get_field('credit_source', $attachment_id);

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
 * Auto-append image credits to image blocks in content
 */
add_filter('render_block', 'altr_auto_image_credits', 10, 2);

function altr_auto_image_credits($block_content, $block)
{
    // Only target image blocks
    if ($block['blockName'] !== 'core/image') {
        return $block_content;
    }

    // Get attachment ID from block
    $id = $block['attrs']['id'] ?? null;
    if (!$id) return $block_content;

    // Get credit
    $credit = altr_get_image_credit($id);
    if (!$credit) return $block_content;

    // Append credit to figcaption
    if (strpos($block_content, '</figcaption>') !== false) {
        // Has existing caption - append
        $block_content = str_replace(
            '</figcaption>',
            ' — ' . $credit . '</figcaption>',
            $block_content
        );
    } else {
        // No caption - add one
        $block_content = str_replace(
            '</figure>',
            '<figcaption class="wp-element-caption text-[11px] font-mono mt-2 text-right">' . $credit . '</figcaption></figure>',
            $block_content
        );
    }

    return $block_content;
}


/**
 * Show warning for missing image credits
 */
add_action('admin_notices', function () {
    global $pagenow, $post;

    if ($pagenow !== 'post.php' || !$post) return;

    // Show URL-based error first
    if (isset($_GET['altr_credits_error'])) {
        echo '<div class="notice notice-error is-dismissible"><p>';
        echo '<strong>❌ Cannot publish:</strong> All images must have photographer credits. ';
        echo 'Click image → Replace → fill credits in Media Library.';
        echo '</p></div>';
        return;
    }

    // Check for missing credits
    $blocks = parse_blocks($post->post_content);
    $missing = 0;

    foreach ($blocks as $block) {
        if ($block['blockName'] === 'core/image') {
            $id = $block['attrs']['id'] ?? null;
            if ($id && !altr_get_image_credit($id)) {
                $missing++;
            }
        }
    }

    if ($missing > 0) {
        echo '<div class="notice notice-warning"><p>';
        echo '<strong>⚠️ ' . $missing . ' image(s) missing credits.</strong> ';
        echo 'Add credits before publishing.';
        echo '</p></div>';
    }
});

/**
 * Prevent publishing without image credits
 */
add_filter('wp_insert_post_data', function ($data, $postarr) {
    // Only check when publishing posts
    if ($data['post_status'] !== 'publish' || $data['post_type'] !== 'post') {
        return $data;
    }

    $blocks = parse_blocks($data['post_content']);

    foreach ($blocks as $block) {
        if ($block['blockName'] === 'core/image') {
            $id = $block['attrs']['id'] ?? null;
            if ($id && !altr_get_image_credit($id)) {
                $data['post_status'] = 'draft';
                add_filter('redirect_post_location', function ($location) {
                    return add_query_arg('altr_credits_error', '1', $location);
                });
                break;
            }
        }
    }

    return $data;
}, 10, 2);


/* ```



---

## Updated Commit Message
```
feat(acf): add image credits with publish validation

- Register credit fields for attachments (photographer*, title, year, source)
- Add altr_get_image_credit() helper for formatted output
- Auto-append credits to image blocks via render_block filter
- Show warning notice when images lack credits
- Prevent publishing posts with uncredited images (reverts to draft)

Ensures all published content properly credits photographers/artists. */

/**
 * Helper function to check if post is featured in blog
 */
function altr_is_featured_blog($post_id = null)
{
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
function altr_get_artist($post_id = null)
{
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
function altr_get_subtitle($post_id = null)
{
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
function altr_get_series_description($post_id = null)
{
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
function altr_the_artist($post_id = null)
{
    $artist = altr_get_artist($post_id);
    if ($artist) {
        echo esc_html($artist);
    }
}



/**
 * Display series description
 */
function altr_the_series_description($post_id = null)
{
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
function altr_get_next_cbd_number()
{
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
function altr_get_series_number($post_id = null)
{
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
function altr_the_series_number($post_id = null)
{
    $number = altr_get_series_number($post_id);
    if ($number) {
        echo '<sup>' . esc_html($number) . '</sup>';
    }
}
