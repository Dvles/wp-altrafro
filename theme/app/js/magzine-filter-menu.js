const toggle = document.getElementById('filterToggle');
const menu   = document.getElementById('mobileFilterMenu');
const current = document.getElementById('filterCurrent');

if (toggle && menu) {
  toggle.addEventListener('click', () => {
    const open = !menu.classList.contains('hidden');
    menu.classList.toggle('hidden');
    toggle.setAttribute('aria-expanded', String(!open));
  });

  menu.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-category]');
    if (!btn) return;

    const label = btn.textContent.trim();
    current.textContent = label;

    // here you also trigger your filtering
    // filterPosts(btn.dataset.category);

    menu.classList.add('hidden');
    toggle.setAttribute('aria-expanded', 'false');
  });
}
