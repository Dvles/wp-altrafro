<?php
/**
 * Theme filters and hooks
 *
 * @package altr
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom class to menu items for search trigger
 */
function altr_search_menu_class($classes, $item, $args) {
    // Check if this menu item has "search" in the URL or navigation label
    if (stripos($item->url, '#search') !== false || 
        stripos($item->title, 'search') !== false || 
        stripos($item->title, 'rechercher') !== false) {
        $classes[] = 'search-trigger-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'altr_search_menu_class', 10, 3);