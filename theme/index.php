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
  'heading' => 'Magazine1'
]);
?>


<!-- POST GRID -->
<?php
get_template_part('template-parts/layouts/post-grid');
?>









<?php get_footer(); ?>