<?php

/**
 * Page header layout
 * 
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

<script>
document.addEventListener('DOMContentLoaded', () => {
  const header   = document.getElementById('pageHeader');
  const sentinel = document.getElementById('sticky-sentinel');
  const col      = header.parentElement;

  const applyFixedMetrics = () => {
    const rect = col.getBoundingClientRect();
    header.style.left  = `${rect.left}px`;
    header.style.width = `${rect.width}px`;
    header.style.top   = `0`; // stick right under the browser top
  };

  const clearFixedMetrics = () => {
    header.style.left = header.style.width = header.style.top = '';
  };

  const setFixed = (fixed) => {
    header.classList.toggle('is-fixed', fixed);
    fixed ? applyFixedMetrics() : clearFixedMetrics();
  };

  // Trigger when the sentinel crosses the viewport top
  const io = new IntersectionObserver(([entry]) => {
    setFixed(entry.boundingClientRect.top < 0);
  }, { threshold: 0 });

  io.observe(sentinel);

  // Keep position correct on resize/orientation changes
  window.addEventListener('resize', () => {
    if (header.classList.contains('is-fixed')) applyFixedMetrics();
  });
  window.addEventListener('orientationchange', () => {
    if (header.classList.contains('is-fixed')) applyFixedMetrics();
  });
});
</script>
