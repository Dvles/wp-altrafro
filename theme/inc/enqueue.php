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
function altr_enqueue_assets()
{
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
    $sticky_page_header_js_path = get_theme_file_path('app/js/sticky-page-header.js');
    $sticky_page_header_js_ver = file_exists($sticky_page_header_js_path) ? filemtime($sticky_page_header_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-sticky-page-header', get_theme_file_uri('app/js/sticky-page-header.js'), [], $sticky_page_header_js_ver, true);

    // Sticky blog aside JS (FIXED: removed extra 'r' and double $$)
    $sticky_blog_js_path = get_theme_file_path('app/js/sticky-blog-aside.js');
    $sticky_blog_js_ver = file_exists($sticky_blog_js_path) ? filemtime($sticky_blog_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-sticky-blog-aside', get_theme_file_uri('app/js/sticky-blog-aside.js'), [], $sticky_blog_js_ver, true);

    // Filter posts JS (FIXED: removed extra 'e' and added localize_script)
    $filter_posts_js_path = get_theme_file_path('app/js/filter-posts.js');
    $filter_posts_js_ver = file_exists($filter_posts_js_path) ? filemtime($filter_posts_js_path) : ALTR_VERSION;
    wp_enqueue_script('altr-filter-posts', get_theme_file_uri('app/js/filter-posts.js'), [], $filter_posts_js_ver, true);


    // Dropdown filter menu for magazine filters
    $filter_menu_js_path = get_theme_file_path('app/js/magazine-filter-menu.js');
    $filter_menus_js_ver = file_exists($filter_menu_js_path) ? filemtime($filter_menu_js_path) : ALTR_VERSION;

    wp_enqueue_script(
        'altr-filter-magazine-filter-menu',
        get_theme_file_uri('app/js/magazine-filter-menu.js'),
        [],
        $filter_menus_js_ver,
        true
    );

    // Post block styles
    add_action('enqueue_block_editor_assets', function () {
        wp_enqueue_script(
            'altr-block-styles',
            get_template_directory_uri() . '/block-styles.js',
            ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
            filemtime(get_template_directory() . '/block-styles.js')
        );
    });






    // Localize script to pass ajaxurl to JavaScript
    wp_localize_script('altr-filter-posts', 'altrAjax', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'altr_enqueue_assets', 20);
