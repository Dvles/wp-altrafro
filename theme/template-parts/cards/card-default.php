<?php
/**
 * Template part for displaying a standard post card
 *
 * @package altr
 */
?>
<article class="relative z-10 border border-black bg-white hover:bg-hypergreen h-full flex flex-col">
    <!-- Featured Image + Category Label -->
    <div class="relative border-b border-black">
        <!-- Image links to article -->
        <a href="<?php the_permalink(); ?>" class="block">
            <img
                class="w-full h-full object-cover"
                src="https://placehold.co/600x400"
                alt="" />
        </a>
        <!-- Category (separate link) -->
        <?php
        $categories = get_the_category();
        if ($categories) : ?>
            
               <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
                class="absolute top-0 left-0 bg-black text-white text-[10px] uppercase tracking-wide global-padding z-10">
                <?php echo esc_html(strtoupper($categories[0]->name)); ?>
            </a>
        <?php endif; ?>
    </div>
    
    <!-- Card Title Box -->
    
        <a href="<?php the_permalink(); ?>"
        class="block border-b border-black hover:bg-hypergreen transition flex-1 min-h-32">
        <h2 class="card-title-default global-padding">
            <?php echo altr_get_display_title(); ?>
        </h2>
    </a>
    
    <!-- Meta Row -->
    <div class="flex-none flex flex-row min-h-[48px]">
        <!-- Time -->
        <div class="meta-tags border-r border-black flex-shrink-0">
            <span class="meta-date global-padding block py-2 whitespace-nowrap">
                <?php echo altr_time_ago(); ?>
            </span>
        </div>
        
        <!-- Tags (responsive) -->
        <div class="meta-tags global-padding flex items-center overflow-hidden min-w-0 flex-1">
            <div class="flex gap-2 2xl:gap-4 overflow-hidden">
                <?php
                $post_tags = get_the_tags();
                if ($post_tags) {
                    $tag_count = 0;
                    $max_tags = 2; // Show max 2 tags
                    
                    foreach ($post_tags as $tag) {
                        if ($tag_count >= $max_tags) break;
                        
                        // Truncate long tag names at 2lg breakpoint
                        $tag_name = strtoupper($tag->name);
                        ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>" 
                           class="meta-cat whitespace-nowrap">
                            <span class="hidden xl:inline">#<?php echo $tag_name; ?></span>
                            <span class="xl:hidden">#<?php echo substr($tag_name, 0, 12) . (strlen($tag_name) > 12 ? '...' : ''); ?></span>
                        </a>
                        <?php
                        $tag_count++;
                    }
                } else {
                    echo '<span class="meta-cat text-gray-400">#NOTAGS</span>';
                }
                ?>
            </div>
        </div>
    </div>
</article>