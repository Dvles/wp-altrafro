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