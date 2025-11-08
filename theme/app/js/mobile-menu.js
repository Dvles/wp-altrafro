document.addEventListener('DOMContentLoaded', () => {
  const menuTrigger = document.getElementById('mobile-menu-trigger');
  const menuClose = document.getElementById('mobile-menu-close');
  const hamburgerIcon = document.getElementById('hamburger-icon');
  const closeIcon = document.getElementById('close-icon');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuBackdrop = document.getElementById('menu-backdrop');
  
  // Open mobile menu
  menuTrigger?.addEventListener('click', () => {
    // Toggle hamburger/close icons in header
    hamburgerIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
    
    // Show backdrop
    menuBackdrop.classList.remove('hidden');
    setTimeout(() => menuBackdrop.classList.add('active'), 10);
    
    // Slide menu down
    mobileMenu.classList.remove('-translate-y-full');
  });
  
  // Close mobile menu
  menuClose?.addEventListener('click', () => {
    closeMenu();
  });
  
  // Close when clicking backdrop
  menuBackdrop?.addEventListener('click', () => {
    closeMenu();
  });
  
  function closeMenu() {
    // Reset icons in header
    hamburgerIcon.classList.remove('hidden');
    closeIcon.classList.add('hidden');
    
    // Slide menu up
    mobileMenu.classList.add('-translate-y-full');
    
    // Hide backdrop
    menuBackdrop.classList.remove('active');
    setTimeout(() => menuBackdrop.classList.add('hidden'), 300);
  }
});