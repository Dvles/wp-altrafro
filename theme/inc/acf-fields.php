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
