<?php
/**
 * ACF helper functions
 *
 * @package altr
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if post is featured in blog
 */
function altr_is_featured_blog($post_id = null)
{
    if (!function_exists('get_field')) {
        return false;
    }
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return (bool) get_field('is_featured_blog', $post_id);
}

/**
 * Get artist name
 */
function altr_get_artist($post_id = null)
{
    if (!function_exists('get_field')) {
        return '';
    }
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_field('artist', $post_id) ?: '';
}

/**
 * Display artist name
 */
function altr_the_artist($post_id = null)
{
    $artist = altr_get_artist($post_id);
    if ($artist) {
        echo esc_html($artist);
    }
}

/**
 * Get subtitle
 */
function altr_get_subtitle($post_id = null)
{
    if (!function_exists('get_field')) {
        return '';
    }
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    $subtitle = get_field('subtitle', $post_id) ?: '';
    $title = get_the_title($post_id);
    if ($subtitle && strpos($title, '30?') !== false) {
        $subtitle .= ', révélé en 30 questions';
    }
    return $subtitle;
}

/**
 * Get series description
 */
function altr_get_series_description($post_id = null)
{
    if (!function_exists('get_field')) {
        return '';
    }
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_field('series_description', $post_id) ?: '';
}

/**
 * Display series description
 */
function altr_the_series_description($post_id = null)
{
    $series_desc = altr_get_series_description($post_id);
    if ($series_desc) {
        echo esc_html($series_desc);
    }
}

/**
 * Get next CBD series number
 */
function altr_get_next_cbd_number()
{
    global $wpdb;
    $query = "
        SELECT MAX(CAST(pm.meta_value AS UNSIGNED)) as max_number
        FROM {$wpdb->postmeta} pm
        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = 'series_number'
        AND p.post_type = 'post'
        AND p.post_status IN ('publish', 'draft', 'pending')
        AND p.post_title LIKE 'CBD%'
    ";
    $max_number = $wpdb->get_var($query);
    return $max_number ? intval($max_number) + 1 : 44;
}

/**
 * Get series number
 */
function altr_get_series_number($post_id = null)
{
    if (!function_exists('get_field')) {
        return null;
    }
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    $number = get_field('series_number', $post_id);
    return $number ? intval($number) : null;
}

/**
 * Display series number in superscript
 */
function altr_the_series_number($post_id = null)
{
    $number = altr_get_series_number($post_id);
    if ($number) {
        echo '<sup>' . esc_html($number) . '</sup>';
    }
}