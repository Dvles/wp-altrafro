<?php
/**
 * Template part for displaying a compact post card
 *
 * @package altr
 */
?>

<article class="relative z-10 flex border border-black bg-white hover:bg-hypergreen max-h-32">

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
    if ( $categories ) : ?>
      <a
        href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
        class="absolute top-0 left-0 bg-black text-white text-[10px] uppercase tracking-wide global-padding z-10"
      >
        <?php echo esc_html( strtoupper( $categories[0]->name ) ); ?>
      </a>
    <?php endif; ?>
  </div>

  <!-- CONTENT 70% -->
  <div class="basis-[70%] flex flex-col">

    <!-- TITLE AREA (fills remaining height above meta) -->
    <a
      href="<?php the_permalink(); ?>"
      class="flex-1 border-b border-black hover:bg-hypergreen transition flex items-start"
    >
      <h2 class="card-title global-padding">
        /<?php the_title(); ?>/
      </h2>
    </a>

    <!-- META ROW (fixed height) -->
    <div class="flex-none h-12 flex">

      <!-- TIME -->
      <div class="border-r border-black flex items-center">
        <span class="meta-date global-padding block">
          8 hours ago
        </span>
      </div>

      <!-- TAGS -->
      <div class="flex-1 flex items-center">
        <div class="meta-tags global-padding">
          <a href="/category/creative-direction" class="meta-cat">#CREATIVEDIRECTION</a>
          <a href="/category/mixed-media" class="meta-cat">#MIXEDMEDIA</a>
        </div>
      </div>

    </div>
  </div>

</article>
