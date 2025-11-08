<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-paper text-ink font-metro debug-cols'); ?>>
  <header class="fixed left-0 right-0 z-40">
    <div class="wrapper-nopad">
      <div class="page-grid">
        <!-- Logo: always visible -->
        <a href="<?= esc_url(home_url('/')); ?>" class="h-16 md:h-auto col-span-2 lg:col-span-1 flex border-l border-b border-r border-black bg-white/90 backdrop-blur z-30">
          <span class="block w-full bg-black"></span>
        </a>

        <!-- Search overlay -->
        <?php get_template_part('template-parts/search-overlay'); ?>

        <!-- Mobile menu trigger -->
        <button id="mobile-menu-trigger" class="visible h-16 lg:h-auto lg:hidden col-span-2 flex items-center justify-center border-b border-r border-l border-black bg-white/90 backdrop-blur z-30">
          <!-- Hamburger icon  -->
          <img id="hamburger-icon" src="<?php echo get_template_directory_uri(); ?>/template-parts/icons/hamburger.svg" alt="Menu" class="lg:hidden w-6 h-6">
          <!-- Close icon  -->
          <img id="close-icon" src="<?php echo get_template_directory_uri(); ?>/template-parts/icons/close.svg" alt="Close" class="w-6 h-6 hidden">
        </button>

        <!-- Mobile menu overlay -->
        <?php get_template_part('template-parts/mobile-menu'); ?>
        
        <!-- Desktop Nav -->
        <nav id="main-nav"
     class="hidden lg:block lg:col-span-3 transition-all duration-500 ease-in-out bg-white/90 backdrop-blur relative z-50">

          <div class="grid grid-cols-3 grid-rows-2">
            <?php
            $loc   = get_nav_menu_locations();
            $items = isset($loc['primary']) ? (wp_get_nav_menu_items($loc['primary']) ?: []) : [];
            $cells = array_pad(array_slice($items, 0, 6), 6, null);
            $count = 0;
            foreach ($cells as $item) {
              $count++;
              $borderClass = 'border-r border-b border-black';
              if ($count === 1 || $count === 4) {
                $borderClass .= ' border-l';
              }
              if ($item) {
                $isSearch = (stripos($item->url, '#search') !== false) ||
                  (stripos($item->title, 'search') !== false) ||
                  (stripos($item->title, 'rechercher') !== false);
                $extraClass = $isSearch ? ' search-trigger-item' : '';
                echo '<a class="flex items-center justify-center py-4 text-[10px] uppercase tracking-wide hover:bg-black hover:text-white transition ' . $borderClass . $extraClass . '" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
              } else {
                echo '<span class="py-4 ' . $borderClass . '"></span>';
              }
            }
            ?>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <main class="wrapper py-8 md:py-12">