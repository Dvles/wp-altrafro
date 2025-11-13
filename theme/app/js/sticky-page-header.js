document.addEventListener('DOMContentLoaded', () => {
  const header   = document.getElementById('pageHeader');
  const sentinel = document.getElementById('sticky-sentinel');
  const col      = header.parentElement;

  const applyFixedMetrics = () => {
    const rect = col.getBoundingClientRect();
    header.style.left  = `${rect.left}px`;
    header.style.width = `${rect.width}px`;
    header.style.top   = `0`; // stick right under the browser top
  };

  const clearFixedMetrics = () => {
    header.style.left = header.style.width = header.style.top = '';
  };

  const setFixed = (fixed) => {
    header.classList.toggle('is-fixed', fixed);
    fixed ? applyFixedMetrics() : clearFixedMetrics();
  };

  // Trigger when the sentinel crosses the viewport top
  const io = new IntersectionObserver(([entry]) => {
    setFixed(entry.boundingClientRect.top < 0);
  }, { threshold: 0 });

  io.observe(sentinel);

  // Keep position correct on resize/orientation changes
  window.addEventListener('resize', () => {
    if (header.classList.contains('is-fixed')) applyFixedMetrics();
  });
  window.addEventListener('orientationchange', () => {
    if (header.classList.contains('is-fixed')) applyFixedMetrics();
  });
});