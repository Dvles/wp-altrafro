let lastScrollY = window.scrollY;
let ticking = false;

const nav = document.getElementById('main-nav');
const scrollThreshold = 100; // Start hiding after 100px scroll

function updateNavVisibility() {
  const currentScrollY = window.scrollY;
  
  // Only apply behavior after scrolling past threshold
  if (currentScrollY > scrollThreshold) {
    if (currentScrollY > lastScrollY) {
      // Scrolling down - hide nav (slide up)
      nav.style.transform = 'translateY(-100%)';
      nav.style.opacity = '0';
    } else {
      // Scrolling up - show nav (slide down)
      nav.style.transform = 'translateY(0)';
      nav.style.opacity = '1';
    }
  } else {
    // At top of page - always show nav
    nav.style.transform = 'translateY(0)';
    nav.style.opacity = '1';
  }
  
  lastScrollY = currentScrollY;
  ticking = false;
}

function onScroll() {
  if (!ticking) {
    window.requestAnimationFrame(updateNavVisibility);
    ticking = true;
  }
}

// Listen for scroll events
window.addEventListener('scroll', onScroll, { passive: true });