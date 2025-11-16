console.log('magazine-filter-menu.js loaded');

document.addEventListener('DOMContentLoaded', () => {
  const toggle    = document.getElementById('filterToggle');
  const menu      = document.getElementById('mobileFilterMenu');
  const current   = document.getElementById('filterCurrent');
  const backdrop  = document.getElementById('filter-backdrop');

  if (!toggle || !menu) return;

  function openMenu() {
    // align dropdown with the start of the label
    if (current && menu) {
      const rect = current.getBoundingClientRect();
      const parentRect = toggle.getBoundingClientRect();
      const offsetLeft = rect.left - parentRect.left;

      menu.style.left = `${offsetLeft}px`;
    }

    menu.classList.remove('hidden');
    backdrop?.classList.remove('hidden');
    // allow pointer events + fade in
    requestAnimationFrame(() => {
      backdrop?.classList.remove('pointer-events-none');
      backdrop?.classList.add('opacity-100');
    });
    toggle.setAttribute('aria-expanded', 'true');
  }

  function closeMenu() {
    menu.classList.add('hidden');
    if (backdrop) {
      backdrop.classList.add('pointer-events-none');
      backdrop.classList.remove('opacity-100');
      // wait for transition, then hide
      setTimeout(() => backdrop.classList.add('hidden'), 300);
    }
    toggle.setAttribute('aria-expanded', 'false');
  }

  // Toggle open/close
  toggle.addEventListener('click', (e) => {
    e.preventDefault();
    const isOpen = toggle.getAttribute('aria-expanded') === 'true';
    if (isOpen) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  // Click on backdrop closes menu
  backdrop?.addEventListener('click', () => {
    closeMenu();
  });

  // Click on an option: update label + trigger filtering + close
  menu.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-category]');
    if (!btn) return;

    e.preventDefault();

    const label    = btn.textContent.trim();
    const category = btn.dataset.category;

    if (current) current.textContent = label;

    // Trigger your existing filter logic if available
    if (window.filterPosts) {
      window.filterPosts(category);
    } else {
      // Fallback: dispatch a custom event; your filter-posts.js can listen for this
      document.dispatchEvent(new CustomEvent('magazineFilterChange', {
        detail: { category }
      }));
    }

    closeMenu();
  });
});
