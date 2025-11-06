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
      <a href="<?= esc_url(home_url('/')); ?>" class="col-span-1 flex border-l border-b border-r border-black bg-white/90 backdrop-blur">
        <span class="block w-full bg-black"></span>
      </a>
      
      <!-- Empty space: 8 columns with bottom border -->
      <div class="col-span-8 border-b border-white bg-white/90 "></div>
      
      <!-- Nav: hide on scroll down, show on scroll up -->
      <nav id="main-nav" class="hidden md:block col-span-3 transition-transform duration-300 bg-white/90 backdrop-blur">
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
              echo '<a class="flex items-center justify-center py-4 text-[10px] uppercase tracking-wide hover:bg-black hover:text-white transition '.$borderClass.'" href="'.esc_url($item->url).'">'.esc_html($item->title).'</a>';
            } else {
              echo '<span class="py-4 '.$borderClass.'"></span>';
            }
          }
          ?>
        </div>
      </nav>
    </div>
  </div>
</header>
<main class="wrapper py-8 md:py-12">