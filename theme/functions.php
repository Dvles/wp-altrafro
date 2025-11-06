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
  wp_enqueue_style('altr-app', get_theme_file_uri('dist/assets/app.css'), [], null);
  wp_enqueue_script('altr-main', get_theme_file_uri('dist/assets/main.js'), [], null, true);
});

