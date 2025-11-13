<?php
/**
 * Template part for responsive magazine post grid
 *
 * @package altr
 */
?>
<section class="wrapper py-12 pt-44">
    <div class="grid grid-cols-12 flex gap-x-[var(--grid-gutter)]">
        
        <!-- LEFT VERTICAL STRIP - Sticky sidebar (hidden on mobile) -->
        <aside class="hidden lg:block flex-shrink-0 col-span-1" style="width: calc((100% - (var(--grid-gutter) * 11)) / 12);">
            <div class="top-[100px] h-screen flex items-end justify-center pb-12">
                <span class="!sticky top-0 block uppercase tracking-wide text-7xl 
                    [writing-mode:vertical-lr] [text-orientation:mixed] rotate-180">
                    <!-- ART>ART>ART>ART>ART>ART>ART>ART>ART> -->
                </span>
            </div>
        </aside>
        
        <!-- RIGHT CONTENT - Grid for cards -->
        <div class="col-span-12 lg:col-span-11">
            <div class="flex-1">
                <div id="posts-grid" class="grid grid-cols-12 lg:grid-cols-11 gap-y-8 lg:gap-y-28 gap-x-[var(--grid-gutter)]">
                    <?php
                    $mag_query = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => -1,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ]);
                    
                    if ($mag_query->have_posts()) :
                        $i = 0;
                        while ($mag_query->have_posts()) :
                            $mag_query->the_post();
                            $i++;
                            
                            // First post on mobile is default card, rest are compact
                            $is_mobile_featured = ($i === 1);
                            ?>
                            
                            <!-- MOBILE: Featured card (first post only) -->
                            <?php if ($is_mobile_featured) : ?>
                                <article class="col-span-10 col-start-3 lg:hidden">
                                    <?php get_template_part('template-parts/cards/card', 'default'); ?>
                                </article>
                            <?php endif; ?>
                            
                            <!-- MOBILE: Compact cards (all posts except first) -->
                            <?php if (!$is_mobile_featured) : ?>
                                <article class="col-span-10  col-start-3 lg:hidden">
                                    <?php get_template_part('template-parts/cards/card', 'compact'); ?>
                                </article>
                            <?php endif; ?>
                            
                            <!-- DESKTOP: All posts as default cards -->
                            <article class="hidden lg:block lg:col-span-5 2lg:col-span-3">
                                <?php get_template_part('template-parts/cards/card', 'default'); ?>
                            </article>
                            
                            <?php
                            // Desktop spacer logic (lg: 2 cards, 2lg: 3 cards per row)
                            $show_on_lg = ($i % 2 !== 0);
                            $show_on_2lg = ($i % 3 !== 0);
                            
                            if ($show_on_lg && $show_on_2lg) {
                                echo '<div class="hidden lg:block col-span-1 spacer"></div>';
                            } elseif ($show_on_lg && !$show_on_2lg) {
                                echo '<div class="hidden lg:block 2lg:hidden col-span-1 spacer"></div>';
                            } elseif (!$show_on_lg && $show_on_2lg) {
                                echo '<div class="hidden lg:hidden 2lg:block col-span-1 spacer"></div>';
                            }
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p class="col-span-12">No articles yet.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
        
    </div>
</section>