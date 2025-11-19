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
function altr_register_acf_fields()
{
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