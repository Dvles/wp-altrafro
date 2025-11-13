<?php
/**
 * AJAX handler for filtering posts by category
 */
function altr_filter_posts() {

        error_log('AJAX filter_posts called'); // Add this
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    
    $args = [
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    
    if ($category !== 'all') {
        $args['category_name'] = $category;
    }
    
    $query = new WP_Query($args);
    ob_start();
    
    if ($query->have_posts()) {
        $i = 0;
        while ($query->have_posts()) {
            $query->the_post();
            $i++;
            
            $is_mobile_featured = ($i === 1);
            ?>
            
            <!-- MOBILE: Featured card (first post only) -->
            <?php if ($is_mobile_featured) : ?>
                <article class="col-span-8 col-start-3 lg:hidden">
                    <?php include(locate_template('template-parts/cards/card-default.php')); ?>
                </article>
            <?php endif; ?>
            
            <!-- MOBILE: Compact cards (all posts except first) -->
            <?php if (!$is_mobile_featured) : ?>
                <article class="col-span-8 col-start-3 lg:hidden">
                    <?php include(locate_template('template-parts/cards/card-compact.php')); ?>
                </article>
            <?php endif; ?>
            
            <!-- DESKTOP: All posts as default cards -->
            <article class="hidden lg:block lg:col-span-5 2lg:col-span-3">
                <?php include(locate_template('template-parts/cards/card-default.php')); ?>
            </article>
            
            <?php
            // Desktop spacer logic
            $show_on_lg = ($i % 2 !== 0);
            $show_on_2lg = ($i % 3 !== 0);
            
            if ($show_on_lg && $show_on_2lg) {
                echo '<div class="hidden lg:block col-span-1 spacer"></div>';
            } elseif ($show_on_lg && !$show_on_2lg) {
                echo '<div class="hidden lg:block 2lg:hidden col-span-1 spacer"></div>';
            } elseif (!$show_on_lg && $show_on_2lg) {
                echo '<div class="hidden lg:hidden 2lg:block col-span-1 spacer"></div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo '<p class="col-span-12">No articles found in this category.</p>';
    }
    
    $html = ob_get_clean();
    wp_send_json_success(['html' => $html]);
}

// Register AJAX handlers (for logged-in and non-logged-in users)
add_action('wp_ajax_filter_posts', 'altr_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'altr_filter_posts');