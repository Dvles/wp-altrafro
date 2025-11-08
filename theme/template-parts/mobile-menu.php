<!-- Backdrop -->
<div id="menu-backdrop" class="lg:hidden fixed inset-0 bg-black opacity-0 transition-opacity duration-300 pointer-events-none hidden z-40"></div>

<!-- Mobile Menu (only as tall as content) -->
<nav id="mobile-menu" class="lg:hidden fixed top-0 left-0 right-0 z-50 -translate-y-full transition-transform duration-500 ease-out">
    <!-- Menu Header (slides with the menu) -->
    <div class="h-16 border-b border-black flex items-center bg-transparent sticky top-0 z-10 bg-white">
        <div class="wrapper-nopad w-full">
            <div class="page-grid items-center">
                <!-- Logo -->
                <a href="<?= esc_url(home_url('/')); ?>" class="h-16 col-span-2 flex border-r border-black">
                    <span class="block w-full bg-black"></span>
                </a>
                <!-- Menu Title -->
                <div class="col-span-8 px-4 h-full flex items-center justify-center menu-title-bg">
                    <h2 class="text-2xl text-center uppercase font-metro font-semibold">Menu</h2>
                </div>
                <!-- Close Button -->
                <div class=" col-span-2 h-16 flex items-center justify-center border-l border-black">
                    <button id="mobile-menu-close" class="w-full h-full flex items-center justify-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/template-parts/icons/close.svg" alt="Close" class="w-6 h-6">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Items -->
    <div class="bg-white max-h-[calc(100vh-4rem)] overflow-y-auto">
        <?php
        $loc = get_nav_menu_locations();
        $items = isset($loc['mobile']) ? wp_get_nav_menu_items($loc['mobile']) : (isset($loc['primary']) ? wp_get_nav_menu_items($loc['primary']) : []);
        $current_url = home_url($_SERVER['REQUEST_URI']);
        if ($items) {
            foreach ($items as $item) {
                $is_current = ($item->url === $current_url);
                if ($is_current) {
                    echo '<span class="font-metro block w-full py-6 px-8 text-center text-2xl uppercase border-b border-black bg-gray-100 text-gray-400 cursor-default">' . esc_html($item->title) . '</span>';
                } else {
                    echo '<a href="' . esc_url($item->url) . '" class="font-metro block w-full py-6 px-8 text-center text-2xl uppercase border-b border-black hover:bg-black hover:text-white transition">' . esc_html($item->title) . '</a>';
                }
            }
        }
        ?>
    </div>
</nav>