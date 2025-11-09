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
      <a
        href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
        class="absolute top-0 left-0 bg-black text-white text-[10px] uppercase tracking-wide global-padding z-10">
        <?php echo esc_html(strtoupper($categories[0]->name)); ?>
      </a>
    <?php endif; ?>
  </div>

  <!-- Card Title Box -->
  <a
    href="<?php the_permalink(); ?>"
    class="block border-b border-black hover:bg-hypergreen transition flex-1 min-h-32 ">
    <h2 class="card-title global-padding">
      /<?php the_title(); ?>/
    </h2>
  </a>

  <!-- Meta Row -->
  <div class="flex-1 flex flex-row">
    <!-- Time -->
    <div class="meta-tags border-r border-black">
      <span class="meta-date global-padding block py-2">8 hours ago</span>
    </div>

    <!-- Tags -->
    <div class="meta-tags global-padding flex items-center space-x-4">
      <a href="/category/creative-direction" class="meta-cat">#CREATIVEDIRECTION</a>
      <a href="/category/mixed-media" class="meta-cat">#MIXEDMEDIA</a>
    </div>
  </div>



</article>