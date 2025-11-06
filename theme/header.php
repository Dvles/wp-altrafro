<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class('bg-paper text-ink font-metro debug-cols'); ?>>
<header class="sticky top-0 z-40 bg-white/90 backdrop-blur">
  <div class="wrapper-nopad">
    <div class="page-grid">
      <!-- Logo: full height with borders -->
      <a href="<?= esc_url(home_url('/')); ?>" class="col-span-1 flex border-l border-b border-r border-black">
        <span class="block w-full bg-black"></span>
      </a>
      
      <!-- Empty space  // fixed content placement on scroll -->
      <div class="col-span-8 border-b border-white"></div>
      
      <!-- Nav: exactly 3 columns with 3x2 internal grid -->
      <nav class="hidden md:block col-span-3">
        <div class="grid grid-cols-3 grid-rows-2">
          <?php
          $loc   = get_nav_menu_locations();
          $items = isset($loc['primary']) ? (wp_get_nav_menu_items($loc['primary']) ?: []) : [];
          $cells = array_pad(array_slice($items, 0, 6), 6, null);
          
          $count = 0;
          foreach ($cells as $item) {
            $count++;
            // All cells get bottom and right borders
            $borderClass = 'border-r border-b border-black';
            // Add left border to first column (positions 1 and 4)
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