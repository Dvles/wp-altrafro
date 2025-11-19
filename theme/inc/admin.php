<?php


/**
 * Admin-only CSS helpers (runs on all admin pages)
 */


/**
 * Find attachment IDs with missing photographer credit
 */
function altr_get_missing_image_ids_for_post( $post_id ) {
    $missing = [];
    $main_content = get_field('main_content', $post_id);

    if (empty($main_content)) {
        return $missing;
    }

    if (preg_match_all('/wp-image-(\d+)/', $main_content, $matches)) {
        foreach ($matches[1] as $attachment_id) {
            $attachment_id = (int) $attachment_id;
            if (!get_post_meta($attachment_id, '_altr_photographer', true)) {
                $missing[] = $attachment_id;
            }
        }
    }

    // unique, just in case
    return array_values(array_unique($missing));
}


/**
 * Admin CSS + JS for image credit warnings
 */
function altr_admin_assets( $hook ) {
    // Only on post edit screens
    if ( $hook !== 'post.php' && $hook !== 'post-new.php' ) {
        return;
    }

    global $post;
    if ( ! $post || $post->post_type !== 'post' ) {
        return;
    }

    $ver = defined('ALTR_VERSION') ? ALTR_VERSION : '1.0.0';

    // Admin CSS (red overlay etc.)
    wp_enqueue_style(
        'altr-admin',
        get_theme_file_uri('dist/assets/admin.css'),
        [],
        $ver
    );

    // Admin JS (your script)
    wp_enqueue_script(
        'altr-admin-image-credits',
        get_theme_file_uri('app/js/admin-image-credits.js'),
        ['jquery'],
        $ver,
        true
    );

    // Build list of missing IDs
    $missing_ids = altr_get_missing_image_ids_for_post( $post->ID );
    $count       = count( $missing_ids );

    // Pass data into JS
    wp_localize_script(
        'altr-admin-image-credits',
        'altrImageCredits',
        [
            'missingIds' => $missing_ids,
            'warning'    => $count
                ? sprintf(
                    _n(
                        'You have %d image without photo credits. Images without credits are hidden on the site. Continue?',
                        'You have %d images without photo credits. Images without credits are hidden on the site. Continue?',
                        $count,
                        'altr-afro'
                    ),
                    $count
                  )
                : '',
        ]
    );
}
add_action( 'admin_enqueue_scripts', 'altr_admin_assets' );
