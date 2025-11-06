<!-- Nav: hide on scroll down, show on scroll up -->
<nav id="main-nav" class="hidden md:block col-span-3 transition-all duration-500 ease-in-out bg-white/90 backdrop-blur relative z-50">
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
        // Check if this is a search trigger
        $isSearch = (stripos($item->url, '#search') !== false) || 
                    (stripos($item->title, 'search') !== false) || 
                    (stripos($item->title, 'rechercher') !== false);
        
        $extraClass = $isSearch ? ' search-trigger-item' : '';
        
        echo '<a class="flex items-center justify-center py-4 text-[10px] uppercase tracking-wide hover:bg-black hover:text-white transition '.$borderClass.$extraClass.'" href="'.esc_url($item->url).'">'.esc_html($item->title).'</a>';
    } else {
        echo '<span class="py-4 '.$borderClass.'"></span>';
    }
    }
    ?>
</div>
</nav>