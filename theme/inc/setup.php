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
function altr_setup() {
    // Load text domain for translations
    load_theme_textdomain(ALTR_TEXT_DOMAIN, get_template_directory() . '/languages');
    
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_editor_style('dist/assets/app.css');
    
    // HTML5 support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);
    
    // Register navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', ALTR_TEXT_DOMAIN),
        'mobile'  => __('Mobile Menu', ALTR_TEXT_DOMAIN),
    ]);
    
    // Image sizes
    add_image_size('altr-hero', 1920, 1080, true);
    add_image_size('altr-card', 600, 400, true);
}
add_action('after_setup_theme', 'altr_setup');