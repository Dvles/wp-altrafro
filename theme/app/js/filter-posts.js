document.addEventListener('DOMContentLoaded', () => {
  const postsGrid   = document.getElementById('posts-grid');
  const filterItems = document.querySelectorAll('.filter-menu-items[data-category]');

  if (!postsGrid) return;

  // Expose globally so other scripts (like the dropdown) can call it
  window.filterPosts = function (category) {
    const cat = category || 'all';

    // Update active state for desktop filters
    filterItems.forEach(el => {
      if (el.dataset.category === cat) {
        el.classList.add('active');
      } else {
        el.classList.remove('active');
      }
    });

    // Loading state
    postsGrid.style.opacity = '0.5';
    postsGrid.style.pointerEvents = 'none';

    fetch(altrAjax.ajaxurl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({
        action: 'filter_posts',
        category: cat,
      }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          postsGrid.innerHTML = data.data.html;
        } else {
          postsGrid.innerHTML = '<p class="col-span-11">No articles found.</p>';
        }

        postsGrid.style.opacity = '1';
        postsGrid.style.pointerEvents = 'auto';
      })
      .catch(error => {
        console.error('Error filtering posts:', error);
        postsGrid.style.opacity = '1';
        postsGrid.style.pointerEvents = 'auto';
      });
  };

  // Desktop: clicking the filter items uses filterPosts
  filterItems.forEach(item => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      const category = item.dataset.category;
      window.filterPosts(category);
    });
  });
});
