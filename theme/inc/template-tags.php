<?php
/**
 * Custom template tags for this theme
 *
 * @package altr
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get human-readable time difference
 *
 * @param int $post_id Post ID (optional, uses current post if not provided)
 * @return string Time difference (e.g., "2 hours ago", "just now")
 */
function altr_time_ago($post_id = null) {
    $post_time = get_the_time('U', $post_id);
    $current_time = current_time('timestamp');
    $time_diff = $current_time - $post_time;
    
    // Less than 1 minute
    if ($time_diff < 60) {
        return __('just now', ALTR_TEXT_DOMAIN);
    }
    
    // Less than 1 hour
    if ($time_diff < 3600) {
        $mins = floor($time_diff / 60);
        return sprintf(_n('%s min ago', '%s mins ago', $mins, ALTR_TEXT_DOMAIN), $mins);
    }
    
    // Less than 24 hours
    if ($time_diff < 86400) {
        $hours = floor($time_diff / 3600);
        return sprintf(_n('%s hour ago', '%s hours ago', $hours, ALTR_TEXT_DOMAIN), $hours);
    }
    
    // Less than 7 days
    if ($time_diff < 604800) {
        $days = floor($time_diff / 86400);
        return sprintf(_n('%s day ago', '%s days ago', $days, ALTR_TEXT_DOMAIN), $days);
    }
    
    // Show actual date for older posts
    return get_the_date('j M Y');
}

/**
 * Display formatted post date
 */
function altr_posted_on() {
    echo '<time class="meta-date">' . altr_time_ago() . '</time>';
}

/**
 * Display post categories
 */
function altr_posted_categories() {
    $categories = get_the_category();
    if (!empty($categories)) {
        echo '<span class="meta-cat">';
        foreach ($categories as $category) {
            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' 
                 . esc_html($category->name) . '</a>';
        }
        echo '</span>';
    }
}

/**
 * Get the complete formatted title with series number in superscript
 *
 * @param int $post_id Optional post ID
 * @return string Complete formatted title with HTML
 */
function altr_get_display_title($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $title = get_the_title($post_id);
    $artist = altr_get_artist($post_id);
    $series_number = altr_get_series_number($post_id);
    
    // Remove any existing superscript numbers from title
    $title = preg_replace('/CBD[⁴⁴⁰¹²³⁴⁵⁶⁷⁸⁹]+/', 'CBD', $title);
    
    // Replace /artist/ placeholder with actual artist name
    if ($artist && strpos($title, '/artist/') !== false) {
        $title = str_replace('/artist/', '/' . strtoupper($artist) . '/', $title);
    }
    
    // Add series number in superscript for CBD posts
    if ($series_number && strpos($title, 'CBD') !== false) {
        $title = preg_replace('/CBD/', 'CBD<sup>' . $series_number . '</sup>', $title, 1);
    }
    
    return $title;
}