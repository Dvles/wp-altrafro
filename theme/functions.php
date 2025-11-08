<?php
/**
 * Theme Setup
 */
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_editor_style('dist/assets/app.css');
  
  register_nav_menus([
    'primary' => __('Primary Menu', 'altr'),
    'mobile'  => __('Mobile Menu', 'altr'),
  ]);
});

/**
 * Enqueue Scripts and Styles
 */
add_action('wp_enqueue_scripts', function () {
  // CSS
  $css_path = get_theme_file_path('dist/assets/app.css');
  $css_ver = file_exists($css_path) ? filemtime($css_path) : '1.0.0';
  wp_enqueue_style('altr-app', get_theme_file_uri('dist/assets/app.css'), [], $css_ver);
  
  // Main JS
  $js_path = get_theme_file_path('dist/assets/main.js');
  $js_ver = file_exists($js_path) ? filemtime($js_path) : '1.0.0';
  wp_enqueue_script('altr-main', get_theme_file_uri('dist/assets/main.js'), [], $js_ver, true);
  
  // Header scroll JS
  $header_js_path = get_theme_file_path('app/js/header-scroll.js');
  $header_js_ver = file_exists($header_js_path) ? filemtime($header_js_path) : '1.0.0';
  wp_enqueue_script('altr-header-scroll', get_theme_file_uri('app/js/header-scroll.js'), [], $header_js_ver, true);
  
  // Search toggle JS
  $search_js_path = get_theme_file_path('app/js/search-toggle.js');
  $search_js_ver = file_exists($search_js_path) ? filemtime($search_js_path) : '1.0.0';
  wp_enqueue_script('altr-search-toggle', get_theme_file_uri('app/js/search-toggle.js'), [], $search_js_ver, true);
  
  // Mobile menu JS (ADD THIS!)
  $mobile_js_path = get_theme_file_path('app/js/mobile-menu.js');
  $mobile_js_ver = file_exists($mobile_js_path) ? filemtime($mobile_js_path) : '1.0.0';
  wp_enqueue_script('altr-mobile-menu', get_theme_file_uri('app/js/mobile-menu.js'), [], $mobile_js_ver, true);
}, 20);

/**
 * Add custom class to menu items for search trigger
 */
add_filter('nav_menu_css_class', function($classes, $item, $args) {
  // Check if this menu item has "search" in the URL or navigation label
  if (stripos($item->url, '#search') !== false || stripos($item->title, 'search') !== false || stripos($item->title, 'rechercher') !== false) {
    $classes[] = 'search-trigger-item';
  }
  return $classes;
}, 10, 3);