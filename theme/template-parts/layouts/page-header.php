<?php
/**
 * Generic sticky page header
 * Uses sticky-page-header.js
 *
 * @package altr
 */

$heading      = $args['heading']      ?? 'Page title';
$subheading   = $args['subheading']   ?? '';
$filters      = $args['filters']      ?? [];   // array of filters or []
$show_filters = !empty($filters);              // show filter nav?
?>


<style>
  .is-fixed { position: fixed; top: 0; padding-bottom: 1px; }
</style>


<section class="page-grid">
  <!-- Page Header Column -->
  <div class="relative col-start-3 col-end-11 lg:col-start-2 lg:col-end-10">
    <!-- Sentinel sits above the header to trigger fixing -->
    <div id="sticky-sentinel" class="h-px"></div>
    
    <!-- Mobile: min-h-screen-63px with no vertical padding, Desktop: min-h-screen-95px with py-4 -->
    <div
      id="pageHeader"
      class="bg-white min-h-screen-63px px-4 py-0 lg:min-h-screen-95px
             z-40 transition-all duration-300 lg:py-4
             flex flex-col justify-center lg:justify-start"
    >
      <h2 class="page-title"><?php echo esc_html($heading); ?></h2>

      <?php if ($subheading) : ?>
        <p class="text-sm uppercase tracking-wide mt-1">
          <?php echo esc_html($subheading); ?>
        </p>
      <?php endif; ?>

      <?php if ($show_filters) : ?>
        <?php
        get_template_part(
          'template-parts/components/magazine-filter-menu',
          null,
          ['filters' => $filters, 'variant' => 'desktop']
        );

        get_template_part(
          'template-parts/components/magazine-filter-menu',
          null,
          ['filters' => $filters, 'variant' => 'mobile']
        );
        ?>
      <?php endif; ?>
    </div>
  </div>
  
  <!-- Empty Space Column (matches desktop height) -->
  <div id="pageHeaderSpace" class="relative hidden lg:block lg:col-start-10 lg:col-end-13">
    <div id="empty-space" class="bg-white min-h-screen-63px lg:min-h-screen-95px z-20"></div>
  </div>
</section>
