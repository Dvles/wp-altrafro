<?php
// theme setup
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_editor_style('dist/assets/app.css');
  register_nav_menus([
    'primary' => __('Primary Menu', 'altr'),
  ]);
});

// enqueue compiled assets
add_action('wp_enqueue_scripts', function () {
  // Relative paths inside the theme
  $css = 'dist/assets/app.css';
  $js  = 'dist/assets/main.js';

  // Cache-busting using filemtime (works with child themes too)
  $css_path = get_theme_file_path($css);
  $js_path  = get_theme_file_path($js);

  $css_ver = file_exists($css_path) ? filemtime($css_path) : null;
  $js_ver  = file_exists($js_path)  ? filemtime($js_path)  : null;

  // Enqueue
  wp_enqueue_style('altr-app', get_theme_file_uri($css), [], $css_ver);
  wp_enqueue_script('altr-main', get_theme_file_uri($js), [], $js_ver, true);
}, 20);
