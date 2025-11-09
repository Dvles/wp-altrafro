<?php get_header(); ?>
<!-- FEATURED IMAGE  -->
<section class="h-screen-80 page-grid bg-slate-500 z-30 flex  pb-20   items-end lg:pb-0 lg:items-center">
  <div class="col-start-3 col-end-11  lg:col-start-2 lg:col-end-6">
    <?php
    get_template_part('template-parts/cards/card-featured');
    ?>

  </div>


</section>

<!-- PAGE HEADER -->
<?php
get_template_part('template-parts/layouts/page-header', null, [
  'heading' => 'Magazine'
]);
?>


<h2 class=" pt-44 "></h2>

<?php get_template_part('template-parts/cards/card-default'); ?>
<h2 class=" pt-44 "></h2>
<?php get_template_part('template-parts/cards/card-featured'); ?>



<section class="grid-12">
  <h2 class="hero-headline global-padding pt-44 ">/SAMANTHA SOKO/</h2>
  <p class="hero-description global-padding">CBD⁴⁴; Quand l'émotion prend une forme universelle</p>
  <div class="page-title global-padding">Magazine</div>
  <div class="filter-menu global-padding">
    <a href="#" class="filter-menu-items">.ART</a>
    <a href="#" class="filter-menu-items">.ART</a>
    <a href="#" class="filter-menu-items">.ART</a>
    <a href="#" class="filter-menu-items">.ART</a>
  </div>


  <h2 class="card-title global-padding">CBD⁴⁴; Quand l'émotion prend une forme universelle</h2>
  <div class="">
    <a href="" class="meta-date global-padding">8 hours ago</a>
  </div>
  <div class="meta-tags global-padding">
    <a href="/category/creative-direction" class="meta-cat">#CREATIVEDIRECTION</a>
    <a href="/category/mixed-media" class="meta-cat">#MIXEDMEDIA</a>
  </div>

  <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article class="col-span-12 md:col-span-6 lg:col-span-4 border border-black/15">
        <a href="<?php the_permalink(); ?>" class="block">
          <div class="aspect-[3/4] bg-black/5 flex items-center justify-center">
            <?php if (has_post_thumbnail()) {
              the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']);
            } ?>
          </div>
          <div class="p-4 border-t border-black/10">
            <h2 class="text-base md:text-lg leading-tight"><?php the_title(); ?></h2>
            <div class="mt-2 text-xs text-black/60"><?php echo get_the_date(); ?></div>
          </div>
        </a>
      </article>
    <?php endwhile;
  else: ?>
    <p class="col-span-12">No posts yet.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>