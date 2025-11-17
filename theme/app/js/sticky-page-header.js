document.addEventListener('DOMContentLoaded', () => {
  const header      = document.getElementById('pageHeader');
  const emptySpace  = document.getElementById('empty-space');
  const sentinel    = document.getElementById('sticky-sentinel');
  const col         = header.parentElement;
  const colSpace    = emptySpace.parentElement;

const applyFixedMetrics = () => {
  // Header metrics
  const headerRect = col.getBoundingClientRect();
  header.style.left  = `${headerRect.left}px`;
  header.style.width = `${headerRect.width}px`;  // Keep original width
  header.style.top   = `0`;
  
  // Empty space metrics - start 1px earlier to close gap
  const spaceRect = colSpace.getBoundingClientRect();
  emptySpace.style.left  = `${spaceRect.left - 1}px`;  // Move 1px left
  emptySpace.style.width = `${spaceRect.width + 1}px`; // Extend 1px
  emptySpace.style.top   = `0`;
};

  const clearFixedMetrics = () => {
    header.style.left = header.style.width = header.style.top = '';
    emptySpace.style.left = emptySpace.style.width = emptySpace.style.top = '';
  };

  const setFixed = (fixed) => {
    header.classList.toggle('is-fixed', fixed);
    emptySpace.classList.toggle('is-fixed', fixed);
    header.classList.toggle('is-sticky', fixed);
    emptySpace.classList.toggle('is-sticky', fixed);
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