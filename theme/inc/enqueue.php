<?php
/**
 * Enqueue scripts and styles
 *
 * @package altr
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles and scripts
 */
function altr_enqueue_assets() {
    // CSS
    $css_path = get_theme_file_path('dist/assets/app.css');
    $css_ver = file_exists($css_path) ? filemtime($css_path) : ALTR_VERSION;
    wp_enqueue_style('altr-app', get_theme_file_uri('dist/assets/app.css'), [], $css_ver);
    
    // Main JS
    $js_path = get_theme_file_path('dist/assets/main.js');
    $js_ver = file_exists($js_path) ? filemtime($js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-main', get_theme_file_uri('dist/assets/main.js'), [], $js_ver, true);
    
    // Header scroll JS
    $header_js_path = get_theme_file_path('app/js/header-scroll.js');
    $header_js_ver = file_exists($header_js_path) ? filemtime($header_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-header-scroll', get_theme_file_uri('app/js/header-scroll.js'), [], $header_js_ver, true);
    
    // Search toggle JS
    $search_js_path = get_theme_file_path('app/js/search-toggle.js');
    $search_js_ver = file_exists($search_js_path) ? filemtime($search_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-search-toggle', get_theme_file_uri('app/js/search-toggle.js'), [], $search_js_ver, true);
    
    // Mobile menu JS
    $mobile_js_path = get_theme_file_path('app/js/mobile-menu.js');
    $mobile_js_ver = file_exists($mobile_js_path) ? filemtime($mobile_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-mobile-menu', get_theme_file_uri('app/js/mobile-menu.js'), [], $mobile_js_ver, true);

    // Sticky page header JS
    $mobile_js_path = get_theme_file_path('app/js/sticky-page-header.js');
    $mobile_js_ver = file_exists($mobile_js_path) ? filemtime($mobile_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-sticky-page-header', get_theme_file_uri('app/js/sticky-page-header.js'), [], $mobile_js_ver, true);
}
add_action('wp_enqueue_scripts', 'altr_enqueue_assets', 20);