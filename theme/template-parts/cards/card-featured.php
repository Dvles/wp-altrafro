<?php

/**
 * Template part for displaying card default with featured image in background
 * 
 * @package altr
 */
?>

<article class="relative h-full">
  <div class="relative">
    <!-- Featured Image (full card background) -->
    <?php if (has_post_thumbnail()) : ?>
      <div class="absolute inset-0 z-0">
        <?php the_post_thumbnail('large', [
          'class' => 'w-full h-full object-cover'
        ]); ?>
      </div>
    <?php endif; ?>

    <!-- CATEGORY -->
    <?php
    $categories = get_the_category();

    if ($categories) : ?>
      <a
        href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
        class="absolute left-[-1px] top-0 -translate-y-full
           bg-black text-white px-4 py-2 text-xs uppercase tracking-wide
           hover:bg-gray-800 transition z-20">
        <?php echo esc_html(strtoupper($categories[0]->name)); ?>
      </a>
    <?php else : ?>
      <a
        href="#"
        class="absolute left-[-1px] top-0 -translate-y-full
           bg-black text-white px-4 py-2 text-xs uppercase tracking-wide
           hover:bg-gray-800 transition z-20">
        featured
      </a>
    <?php endif; ?>



    <!-- FEATURED CARD -->
    <a
      href="<?php the_permalink(); ?>"
      class="relative z-10 block border border-black bg-white hover:bg-hypergreen px-4 pb-10 pt-4  transition">
      <div>
        <h2 class="hero-headline mb-4">/<?php the_title(); ?>/</h2>
        <p class="hero-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
      </div>

      <!-- READ BUTTON -->
      <?php
      get_template_part('template-parts/components/button', null, [
        'url' => get_permalink(),
        'label' => 'Read',
        'position' => 'bottom_right',
        'size' => 'medium'
      ]);
      ?>
    </a>
  </div>
</article>