<!-- Backdrop -->
<div id="search-backdrop" class="fixed inset-0 bg-black opacity-0 transition-opacity duration-300 pointer-events-none hidden" style="z-index: 35;"></div>

<!-- Search Bar (initially hidden) -->
<div id="search-bar" class="h-16  lg:h-auto col-span-8 border-b border-black bg-white/90 backdrop-blur hidden relative z-50">
  <div class="flex items-center justify-center h-full px-8 relative">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex-1 max-w-2xl">
      <input 
        id="search-input"
        type="search" 
        name="s" 
        placeholder="RECHERCHER" 
        class="w-full uppercase border-none outline-none bg-transparent text-center font-metro focus:outline-none py-4 text-5xl"
        autocomplete="off"
      />
    </form>
    <button 
      id="search-close" 
      class="absolute right-6 text-3xl leading-none hover:text-gray-600 transition-colors font-light"
      aria-label="Close search"
      type="button"
    >
      ×
    </button>
  </div>
</div>

<!-- Empty space (shown when search is closed) - NO BORDER -->
<div id="search-placeholder" class="h-16 lg:h-auto col-span-8 bg-transparent "></div>