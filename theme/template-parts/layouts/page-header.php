<?php

/**
 * Page header layout
 * 
 * @package altr
 */


$heading    = $args['heading']    ?? 'Page title';
$subheading = $args['subheading'] ?? 'subheading';

?>


<section class="min-h-screen-95px page-grid ">
  <div class="col-start-3 col-end-11  lg:col-start-2 lg:col-end-9 global-padding bg-white z-20">
    <h2 class="page-title"><?php echo esc_html($heading); ?></h2>
    <!-- REPLACE BY CAT FILTER MENU -->
    <div class="filter-menu ">
      <a href="#" class="filter-menu-items">.ART</a>
      <a href="#" class="filter-menu-items">.FASHION</a>
      <a href="#" class="filter-menu-items">.INNOVATION</a>
      <a href="#" class="filter-menu-items">.MUSIC</a>
      <a href="#" class="filter-menu-items">.VISUAL MEDIA</a>
    </div>
  </div>
</section>