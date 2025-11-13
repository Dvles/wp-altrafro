document.addEventListener('DOMContentLoaded', () => {
  const searchBar = document.getElementById('search-bar');
  const searchPlaceholder = document.getElementById('search-placeholder');
  const searchClose = document.getElementById('search-close');
  const searchInput = document.getElementById('search-input');
  const searchBackdrop = document.getElementById('search-backdrop'); 
  const pageHeader = document.getElementById('pageHeader');
  
  // Find all links that point to #search
  const allNavLinks = document.querySelectorAll('nav a[href*="#search"]');

  

  // Open search when clicking any search link
  allNavLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      
      // Hide placeholder, show search bar
      searchPlaceholder?.classList.add('hidden');
      searchBar?.classList.remove('hidden');

      // Hide page header
      pageHeader?.classList.add('hidden');
      
      
      // Show backdrop
      searchBackdrop?.classList.remove('hidden');
      setTimeout(() => searchBackdrop?.classList.add('active'), 10);
      
      // Focus input
      setTimeout(() => searchInput?.focus(), 100);
    });
  });

  // Close search
  const closeSearch = () => {
    searchBar?.classList.add('hidden');
    searchPlaceholder?.classList.remove('hidden');
    if (searchInput) searchInput.value = '';
    
    // Hide backdrop
    searchBackdrop?.classList.remove('active');
    setTimeout(() => searchBackdrop?.classList.add('hidden'), 300);

      // Hide page header
      pageHeader?.classList.remove('hidden');
  };

  searchClose?.addEventListener('click', closeSearch);

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && searchBar && !searchBar.classList.contains('hidden')) {
      e.preventDefault();
      e.stopPropagation();
      closeSearch();
    }
  });
});