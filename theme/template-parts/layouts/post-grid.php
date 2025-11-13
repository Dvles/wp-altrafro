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
<aside class="hidden lg:block flex-shrink-0 col-span-1" style="width: calc((100% - (var(--grid-gutter) * 11)) / 12);">
<div class="top-[100px] h-screen flex items-end justify-center pb-12">
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

if ($mag_query->have_posts()) :
$i = 0;
while ($mag_query->have_posts()) :
$mag_query->the_post();
$i++;
?>
<!-- CARD: 4 cols on lg, 3 cols on 2lg -->
<article class="col-span-12 md:col-span-6 lg:col-span-5 2lg:col-span-3">
<?php get_template_part('template-parts/cards/card', 'default'); ?>
</article>
<?php
// Spacer logic for different breakpoints
$show_on_lg = ($i % 2 !== 0);  // After odd articles on lg (1, 3, 5...)
$show_on_2lg = ($i % 3 !== 0); // After 1st & 2nd of every 3 on 2lg

if ($show_on_lg && $show_on_2lg) {
    // Show on both lg and 2lg
    echo '<div class="hidden lg:block col-span-1 spacer"></div>';
} elseif ($show_on_lg && !$show_on_2lg) {
    // Show only on lg, hide on 2lg
    echo '<div class="hidden lg:block 2lg:hidden col-span-1 spacer"></div>';
} elseif (!$show_on_lg && $show_on_2lg) {
    // Hide on lg, show only on 2lg
    echo '<div class="hidden lg:hidden 2lg:block col-span-1 spacer"></div>';
}
// If both false, don't output spacer
?>
<?php
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