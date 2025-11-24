<?php
/**
 * Theme setup and initialization
 *
 * @package altr
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme text domain
 */
define('ALTR_TEXT_DOMAIN', 'altr-afro');

/**
 * Theme version
 */
define('ALTR_VERSION', '1.0.0');

/**
 * Sets up theme defaults and registers support for various WordPress features
 */
function altr_setup()
{
    // Load text domain for translations
    load_theme_textdomain(ALTR_TEXT_DOMAIN, get_template_directory() . '/languages');

    // Core theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Editor styles (for block editor / classic editor where used)
    add_theme_support('editor-styles');
    add_editor_style([
        'dist/assets/app.css',    // base Tailwind-ish styles (optional)
        'dist/assets/editor.css', // custom editor-only styles (headings, quotes, etc.)
    ]);

    // HTML5 support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    // Navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', ALTR_TEXT_DOMAIN),
        'mobile'  => __('Mobile Menu', ALTR_TEXT_DOMAIN),
    ]);

    // Image sizes
    add_image_size('altr-hero', 1920, 1080, true);
    add_image_size('altr-card', 600, 400, true);
}
add_action('after_setup_theme', 'altr_setup');

/**
 * Disable Gutenberg for posts (we use ACF fields instead)
 */
add_filter('use_block_editor_for_post_type', function ($use, $post_type) {
    if ($post_type === 'post') {
        return false;
    }
    return $use;
}, 10, 2);

/**
 * Remove default content editor from posts
 */
add_action('init', function () {
    remove_post_type_support('post', 'editor');
});

/**
 * Force editor.css into ACF WYSIWYG (Classic TinyMCE inside ACF fields)
 */
add_action('acf/input/admin_head', function () {
    $href = get_theme_file_uri('dist/assets/editor.css');

    printf(
        '<link rel="stylesheet" href="%s?ver=%s" />',
        esc_url($href),
        esc_attr(ALTR_VERSION)
    );
});
