<?php
/**
 * Template part for responsive magzine post grid
 *
 * @package altr
 */
?>
<section class="wrapper py-12 pt-44">
    <div class="grid grid-cols-12 flex gap-x-[var(--grid-gutter)]">
        
        <!-- LEFT VERTICAL STRIP - Sticky sidebar -->
        <aside class=" hidden lg:block flex-shrink-0 col-span-1" style="width: calc((100% - (var(--grid-gutter) * 11)) / 12);">
            <div class=" top-[100px] h-screen flex items-end justify-center pb-12">
                <span class="!sticky top-0 block uppercase tracking-wide text-7xl 
                             [writing-mode:vertical-lr] [text-orientation:mixed] rotate-180">
                    <!-- ART>ART>ART>ART>ART>ART>ART>ART>ART> -->
                </span>
            </div>
        </aside>
        
        <!-- RIGHT CONTENT - Grid for cards -->
         <div class="col-span-11">
             <div class="flex-1">
                 <div id="posts-grid" class="grid grid-cols-11 gap-y-28 gap-x-[var(--grid-gutter)]">
                     
                    <?php
                        $mag_query = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => -1,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                                            ]);
                        if ( $mag_query->have_posts() ) :
                        $i = 0;
                        while ( $mag_query->have_posts() ) :
                        $mag_query->the_post();
                        $i++;
                        ?>
                        <!-- CARD = 3 columns on desktop (3 out of 11 remaining columns) -->
                        <article class="col-span-12 md:col-span-6 lg:col-span-3">
                        <?php get_template_part( 'template-parts/cards/card', 'default' ); ?>
                        </article>
                        <?php
                        // Insert a 1-col gap after card 1 and 2, 4 and 5, 7 and 8, etc.
                        if ( $i % 3 !== 0 ) {
                        echo '<div class="hidden lg:block col-span-1 spacer"></div>';
                                                    }
                        endwhile;
                        wp_reset_postdata();
                        else :
                        echo '<p class="col-span-11">No articles yet.</p>';
                        endif;
                    ?>
                     
                 </div>
             </div>

         </div>
        
    </div>
</section>
