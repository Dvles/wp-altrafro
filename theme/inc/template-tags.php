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
/**
 * Get relative time (with optional short format)
 *
 * @param int $post_id Post ID
 * @param bool $short Use abbreviated format
 * @return string Time ago string
 */
function altr_time_ago($post_id = null, $short = false) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $time_diff = current_time('timestamp') - get_post_time('U', false, $post_id);
    
    if ($time_diff < 60) {
        return $short ? '< 1m' : 'just now';
    } elseif ($time_diff < 3600) {
        $mins = floor($time_diff / 60);
        return $short ? $mins . 'm' : $mins . ' min' . ($mins > 1 ? 's' : '') . ' ago';
    } elseif ($time_diff < 86400) {
        $hours = floor($time_diff / 3600);
        return $short ? $hours . 'h' : $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($time_diff < 604800) {
        $days = floor($time_diff / 86400);
        return $short ? $days . 'd' : $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } elseif ($time_diff < 2592000) {
        $weeks = floor($time_diff / 604800);
        return $short ? $weeks . 'w' : $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
    } else {
        // For older posts, show date
        if ($short) {
            return get_the_date('j M', $post_id); // "4 Nov"
        } else {
            return get_the_date('j M Y', $post_id); // "4 Nov 2025"
        }
    }
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

/**
 * Estimate reading time for a post
 *
 * @param int|null $post_id
 * @param int      $wpm      words per minute
 * @return string            e.g. "4 min"
 */
function altr_get_reading_time($post_id = null, $wpm = 200) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    if (!$content) {
        return '';
    }

    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    if ($word_count === 0) {
        return '';
    }

    $minutes = max(1, ceil($word_count / $wpm));
    return $minutes . ' min';
}
