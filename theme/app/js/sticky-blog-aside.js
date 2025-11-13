document.addEventListener('DOMContentLoaded', () => {
  const blogAside = document.getElementById('blogAside');
  const sentinel = document.getElementById('sticky-sentinel-aside');
  const asideColumn = document.getElementById('blogAsideColumn');
  
  if (!blogAside || !sentinel || !asideColumn) return; // Safety check
  
  const mainSiteHeader = document.querySelector('body > header');

  const getMainHeaderHeight = () => {
    return mainSiteHeader ? mainSiteHeader.offsetHeight : 0;
  };

  const applyFixedMetrics = () => {
    const rect = asideColumn.getBoundingClientRect();
    const headerHeight = getMainHeaderHeight();
    
    blogAside.style.left = `${rect.left}px`;
    blogAside.style.width = `${rect.width}px`;
    blogAside.style.top = `${headerHeight}px`; // Position below main header
  };

  const clearFixedMetrics = () => {
    blogAside.style.left = blogAside.style.width = blogAside.style.top = '';
  };

  const setFixed = (fixed) => {
    blogAside.classList.toggle('is-fixed', fixed);
    fixed ? applyFixedMetrics() : clearFixedMetrics();
  };

  // Trigger when the sentinel crosses the viewport top
  const headerHeight = getMainHeaderHeight();
  const io = new IntersectionObserver(([entry]) => {
    setFixed(entry.boundingClientRect.top < headerHeight);
  }, { 
    threshold: 0,
    rootMargin: `-${headerHeight}px 0px 0px 0px`
  });

  io.observe(sentinel);

  // Keep position correct on resize/orientation changes
  const updateOnResize = () => {
    if (blogAside.classList.contains('is-fixed')) applyFixedMetrics();
  };

  window.addEventListener('resize', updateOnResize);
  window.addEventListener('orientationchange', updateOnResize);
});