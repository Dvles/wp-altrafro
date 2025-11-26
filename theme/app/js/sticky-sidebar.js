/**
 * Sticky Article Sidebar
 * Sticks at 96px offset when scrolled into position
 * Tracks against entire article content area
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('🔧 Sticky Sidebar: Script loaded');
  
  const sidebar = document.getElementById('article-sidebar');
  console.log('🔍 Sidebar element:', sidebar);
  
  if (!sidebar) {
    console.error('❌ Sidebar element #article-sidebar not found!');
    return;
  }
  
  console.log('✅ Sidebar found, initializing...');

  const STICKY_OFFSET = 96; // pixels from top when sticky
  const sidebarParent = sidebar.parentElement;
  
  // Find the article content to track against for overflow
  const articleContent = document.querySelector('.article-content');
  console.log('📄 Article content element:', articleContent);
  
  let isSticky = false;
  let sidebarTop = 0;
  let sidebarHeight = 0;
  let articleBottom = 0;

  /**
   * Calculate initial positions
   */
  const calculatePositions = () => {
    const rect = sidebar.getBoundingClientRect();
    const parentRect = sidebarParent.getBoundingClientRect();
    
    sidebarTop = rect.top + window.scrollY;
    sidebarHeight = rect.height;
    
    // Calculate where the article content ends
    if (articleContent) {
      const articleRect = articleContent.getBoundingClientRect();
      articleBottom = articleRect.bottom + window.scrollY;
    } else {
      // Fallback to parent if article content not found
      articleBottom = parentRect.bottom + window.scrollY;
    }
    
    console.log('📏 Positions calculated:', {
      sidebarTop,
      sidebarHeight,
      articleBottom,
      currentScrollY: window.scrollY,
      triggerPoint: sidebarTop - STICKY_OFFSET
    });
  };

  /**
   * Apply sticky positioning
   */
  const makeSticky = () => {
    if (isSticky) return;
    
    console.log('📌 Making sidebar STICKY');
    isSticky = true;
    sidebar.classList.add('is-sidebar-sticky');
    
    // Set fixed positioning with calculated offset
    sidebar.style.position = 'fixed';
    sidebar.style.top = `${STICKY_OFFSET}px`;
    sidebar.style.left = `${sidebarParent.getBoundingClientRect().left}px`;
    sidebar.style.width = `${sidebarParent.getBoundingClientRect().width}px`;
    
    console.log('✨ Sidebar now fixed at:', {
      top: sidebar.style.top,
      left: sidebar.style.left,
      width: sidebar.style.width
    });
  };

  /**
   * Remove sticky positioning
   */
  const makeRelative = () => {
    if (!isSticky) return;
    
    console.log('📍 Making sidebar RELATIVE (unstick)');
    isSticky = false;
    sidebar.classList.remove('is-sidebar-sticky');
    
    // Reset to normal flow
    sidebar.style.position = '';
    sidebar.style.top = '';
    sidebar.style.left = '';
    sidebar.style.width = '';
  };

  /**
   * Update sticky state based on scroll position
   */
  const updateStickyState = () => {
    const scrollY = window.scrollY;
    const triggerPoint = sidebarTop - STICKY_OFFSET;
    
    // Check if sidebar would scroll past the article bottom
    const sidebarBottomPosition = scrollY + sidebarHeight + STICKY_OFFSET;
    const wouldOverflow = sidebarBottomPosition > articleBottom;

    console.log('🔄 Scroll update:', {
      scrollY,
      triggerPoint,
      shouldStick: scrollY >= triggerPoint,
      wouldOverflow,
      articleBottom,
      sidebarBottomPosition,
      isCurrentlySticky: isSticky
    });

    if (scrollY >= triggerPoint && !wouldOverflow) {
      makeSticky();
    } else {
      makeRelative();
    }
  };

  /**
   * Update fixed positioning on resize
   */
  const updateFixedMetrics = () => {
    if (!isSticky) return;
    
    const parentRect = sidebarParent.getBoundingClientRect();
    sidebar.style.left = `${parentRect.left}px`;
    sidebar.style.width = `${parentRect.width}px`;
    
    console.log('↔️ Updated fixed metrics on resize');
  };

  /**
   * Recalculate everything on resize/orientation change
   */
  const handleResize = () => {
    console.log('🔄 Handling resize/orientation change');
    // Reset to recalculate
    makeRelative();
    calculatePositions();
    updateStickyState();
  };

  // Initial setup
  console.log('⚙️ Running initial setup...');
  calculatePositions();

  // Scroll listener with throttling for performance
  let scrollTimeout;
  window.addEventListener('scroll', () => {
    if (scrollTimeout) return;
    
    scrollTimeout = setTimeout(() => {
      updateStickyState();
      scrollTimeout = null;
    }, 10);
  }, { passive: true });
  console.log('👂 Scroll listener attached');

  // Resize listener with debouncing
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      handleResize();
      updateFixedMetrics();
    }, 150);
  });
  console.log('👂 Resize listener attached');

  // Orientation change
  window.addEventListener('orientationchange', () => {
    setTimeout(handleResize, 200);
  });
  console.log('👂 Orientation change listener attached');

  // Initial check
  console.log('🚀 Running initial sticky check...');
  updateStickyState();
  console.log('✅ Sticky sidebar initialization complete!');
});