<?php
get_header();

// 1. Define filters for this page
$mag_filters = [
    ['slug' => 'all',        'label' => '.ALL'],
    ['slug' => 'art',        'label' => '.ART'],
    ['slug' => 'fashion',    'label' => '.FASHION'],
    ['slug' => 'innovation', 'label' => '.INNOVATION'],
    ['slug' => 'music',      'label' => '.MUSIC'],
];
?>


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
get_template_part(
    'template-parts/layouts/page-header',
    null,
    [
        'heading'    => 'MAGAZINE1', // or get_the_title() if this is a page
        'subheading' => '',
        'filters'    => $mag_filters, // <-- this makes the filter menu appear
        'type' => 'page',
    ]
);
?>


<!-- POST GRID -->
<?php
get_template_part('template-parts/layouts/post-grid');
?>









<?php get_footer(); ?>