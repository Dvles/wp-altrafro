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
                'key' => 'field_artist',
                'label' => 'Artist',
                'name' => 'artist',
                'type' => 'text',
                'instructions' => 'Enter the artist name for this post',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'e.g., Kehinde Wiley',
                'maxlength' => 100,
            ],
            [
                'key' => 'field_series_description',
                'label' => 'Series Description',
                'name' => 'series_description',
                'type' => 'text',
                'instructions' => 'Enter the series description (e.g., Creative by design...)',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'e.g., Creative by design ; exploration artistique approfondie',
                'maxlength' => 200,
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
 * Helper function to get artist name
 *
 * @param int $post_id Optional post ID
 * @return string Artist name or empty string
 */
function altr_get_artist($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return get_field('artist', $post_id) ?: '';
}

/**
 * Display artist name
 *
 * @param int $post_id Optional post ID
 */
function altr_the_artist($post_id = null) {
    $artist = altr_get_artist($post_id);
    if ($artist) {
        echo esc_html($artist);
    }
}

/**
 * Helper function to get series description
 *
 * @param int $post_id Optional post ID
 * @return string Series description or empty string
 */
function altr_get_series_description($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return get_field('series_description', $post_id) ?: '';
}

/**
 * Display series description
 *
 * @param int $post_id Optional post ID
 */
function altr_the_series_description($post_id = null) {
    $series_desc = altr_get_series_description($post_id);
    if ($series_desc) {
        echo esc_html($series_desc);
    }
}