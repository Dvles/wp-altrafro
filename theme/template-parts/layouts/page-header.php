<?php

/**
 * Page header layout
 * Use sticky-page-header.js
 * @package altr
 */


$heading    = $args['heading']    ?? 'Page title';
$subheading = $args['subheading'] ?? 'subheading';

?>

<style>
  .is-fixed { position: fixed; top: 0; }
</style>

<section class="page-grid  ">
  <div class="relative col-start-3 col-end-11 lg:col-start-2 lg:col-end-10">
    <!-- Sentinel sits above the header to trigger fixing -->
    <div id="sticky-sentinel" class="h-px"></div>

    <div id="pageHeader" class="bg-slate-300   min-h-screen-95px z-30 transition-all duration-300 global-padding">
      <h2 class="page-title"><?php echo esc_html($heading); ?></h2>
      <div class="filter-menu">
        <a class="filter-menu-items">.ART</a>
        <a class="filter-menu-items">.FASHION</a>
        <a class="filter-menu-items">.INNOVATION</a>
        <a class="filter-menu-items">.MUSIC</a>
        <a class="filter-menu-items">.VISUAL MEDIA</a>
      </div>
    </div>
  </div>
</section>

