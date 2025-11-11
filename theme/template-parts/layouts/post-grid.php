<?php
/**
 * Template part for responsive magzine post grid
 *
 * @package altr
 */
?>

<section class="wrapper py-12 pt-44">
  <div class="page-grid gap-y-28   ">

    <!-- LEFT VERTICAL STRIP = col-span-1 -->
    <aside class="hidden lg:flex col-span-1 lg:row-span-3 items-stretch">
      <div class="w-full flex items-end">
        <span class="uppercase tracking-wide">
          ART&gt;ART&gt;ART&gt;
        </span>
      </div>
    </aside>

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

        <!-- CARD = 3 columns on desktop -->
        <article class="col-span-12 md:col-span-6 lg:col-span-3 ">
          <?php get_template_part( 'template-parts/cards/card', 'default' ); ?>
        </article>

        <?php
        // Insert a 1-col gap after card 1 and 2, 4 and 5, 7 and 8, etc.
        if ( $i % 3 !== 0 ) {
          echo '<div class="hidden lg:block col-span-1"></div>';
        }

      endwhile;
      wp_reset_postdata();
    else :
      echo '<p class="col-span-12">No articles yet.</p>';
    endif;
    ?>

  </div>
</section>