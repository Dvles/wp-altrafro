<?php

/**
 * AJAX handler for filtering posts by category
 */
function altr_filter_posts() {
    // Get and sanitize the category from the request
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    
    // Setup query arguments
    $args = [
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    
    // Add category filter if not "all"
    if ($category !== 'all') {
        $args['category_name'] = $category;
    }
    
    $query = new WP_Query($args);
    
    // Start output buffering
    ob_start();
    
    if ($query->have_posts()) {
        $i = 0;
        while ($query->have_posts()) {
            $query->the_post();
            $i++;
            ?>
            <article class="col-span-12 md:col-span-6 lg:col-span-3">
                <?php get_template_part('template-parts/cards/card', 'default'); ?>
            </article>
            <?php
            // Insert a 1-col gap after card 1 and 2, 4 and 5, 7 and 8, etc.
            if ($i % 3 !== 0) {
                echo '<div class="hidden lg:block col-span-1 spacer"></div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo '<p class="col-span-11">No articles found in this category.</p>';
    }
    
    // Get the buffered content
    $html = ob_get_clean();
    
    // Send JSON response
    wp_send_json_success(['html' => $html]);
}

// Register AJAX handlers (for logged-in and non-logged-in users)
add_action('wp_ajax_filter_posts', 'altr_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'altr_filter_posts');