<?php
/**
 * Template part for displaying a compact post card
 *
 * @package altr
 */
?>
<article class="relative z-10 flex border border-black bg-white hover:bg-hypergreen h-32">
    <!-- IMAGE 30% -->
    <div class="relative basis-[30%] border-r border-black overflow-hidden">
        <a href="<?php the_permalink(); ?>" class="block h-full w-full">
            <img
                class="w-full h-full object-cover"
                src="https://placehold.co/600x400"
                alt=""
            />
        </a>
        <?php
        $categories = get_the_category();
        if ($categories) : ?>
            
              <a  href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
                class="absolute top-0 left-0 bg-black text-white text-[9.5px] lg:text-[10px] uppercase tracking-wide global-padding-mobile-tags z-10"
            >
                <?php echo esc_html(strtoupper($categories[0]->name)); ?>
            </a>
        <?php endif; ?>
    </div>
    
    <!-- CONTENT 70% -->
    <div class="basis-[70%] flex flex-col h-full">
        <!-- TITLE AREA -->
        <div class="flex-1 border-b border-black overflow-hidden">
            
            <a    href="<?php the_permalink(); ?>"
                class="block h-full hover:bg-hypergreen transition flex items-start"
            >
                <h2 class="card-title global-padding-mobile-cards">
                    <?php echo altr_get_display_title(); ?>
                </h2>
            </a>
        </div>
        
        <!-- META ROW (fixed height) -->
        <div class="flex-none h-10  flex">
            <!-- TIME -->
            <div class="border-r border-black flex items-center">
                <span class="meta-date global-padding block">
                    <?php echo altr_time_ago(); ?>
                </span>
            </div>
            <!-- TAGS -->
            <div class="flex-1 flex items-center overflow-hidden">
                <div class="meta-tags global-padding">
                    <?php
                    $post_tags = get_the_tags();
                    if ($post_tags) {
                        $tag_count = 0;
                        foreach ($post_tags as $tag) {
                            if ($tag_count >= 2) break;
                            echo '<a href="' . get_tag_link($tag->term_id) . '" class="meta-cat">#' . strtoupper($tag->name) . '</a>';
                            $tag_count++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>