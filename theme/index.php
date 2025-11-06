<?php get_header(); ?>

<section class="grid-12">
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article class="col-span-12 md:col-span-6 lg:col-span-4 border border-black/15">
      <a href="<?php the_permalink(); ?>" class="block">
        <div class="aspect-[3/4] bg-black/5 flex items-center justify-center">
          <?php if (has_post_thumbnail()) { the_post_thumbnail('large', ['class'=>'w-full h-full object-cover']); } ?>
        </div>
        <div class="p-4 border-t border-black/10">
          <h2 class="text-base md:text-lg leading-tight"><?php the_title(); ?></h2>
          <div class="mt-2 text-xs text-black/60"><?php echo get_the_date(); ?></div>
        </div>
      </a>
    </article>
  <?php endwhile; else: ?>
    <p class="col-span-12">No posts yet.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
