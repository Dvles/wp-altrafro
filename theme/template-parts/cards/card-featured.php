<?php
/**
 * Template part for displaying card default with feaured image in background
 * 
 * @package altr
 */
?>

<article class="relative bg-white h-full">
  <div class="relative">
    <!-- Featured Image (full card background) -->
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="absolute inset-0 z-0">
        <?php the_post_thumbnail( 'large', [
          'class' => 'w-full h-full object-cover'
        ] ); ?>
      </div>
    <?php endif; ?>

    <!-- Content box with border -->
    <div class="relative z-10 border border-black bg-white hover:bg-hypergreen px-4 py-10">
      <!-- CAT -->
      <?php
      $categories = get_the_category();
      if ( $categories ) : ?>
        <a
          href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
          class="absolute left-[-1px] top-0 -translate-y-full
                 bg-black text-white px-4 py-2 text-xs uppercase tracking-wide
                 hover:bg-gray-800 transition"
        >
          <?php echo esc_html( strtoupper( $categories[0]->name ) ); ?>
        </a>
      <?php endif; ?>

      <!-- Headline  -->
      <h2 class="hero-headline mb-4">
        <a href="<?php the_permalink();?>" class="hover:opacity-70 transition">
          /<?php the_title(); ?>/
        </a>
      </h2>

      <p class="hero-description">
        <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
      </p>

      <!-- READ button: sits on bottom-right edge of THIS box -->
      <a
        href="<?php the_permalink(); ?>"
        class="absolute right-[-1px] bottom-0 translate-y-full
               bg-black text-white px-6 py-2 text-xs uppercase tracking-wide
               hover:bg-gray-800 transition"
      >
        Read
      </a>
    </div>
  </div>
</article>