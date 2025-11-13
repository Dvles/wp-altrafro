document.addEventListener('DOMContentLoaded', () => {
    const filterItems = document.querySelectorAll('.filter-menu-items');
    const postsGrid = document.getElementById('posts-grid');
    
    if (!filterItems.length || !postsGrid) return;
    
    filterItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior (page jump/reload)
            const category = item.dataset.category; // Get category slug from data-category attribute
            
            // Update active state
            filterItems.forEach(el => el.classList.remove('active'));
            item.classList.add('active');
            
            // Show loading state
            postsGrid.style.opacity = '0.5';
            postsGrid.style.pointerEvents = 'none';
            
            // Fetch filtered posts via AJAX
            fetch(altrAjax.ajaxurl, { // FIXED: Use localized ajaxurl
                method: 'POST', // Use POST method to send data
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // Tell server we're sending form data
                },
                body: new URLSearchParams({ // Prepare data to send
                    action: 'filter_posts', // WordPress action name (matches functions.php)
                    category: category, // Category slug to filter by
                })
            })
            .then(response => response.json()) // Convert response to JSON
            .then(data => { // Handle the response data
                if (data.success) { // If server returned success
                    postsGrid.innerHTML = data.data.html; // Replace grid with filtered posts
                } else { // If no posts found
                    postsGrid.innerHTML = '<p class="col-span-11">No articles found.</p>';
                }
                
                // Remove loading state
                postsGrid.style.opacity = '1';
                postsGrid.style.pointerEvents = 'auto';
            })
            .catch(error => { // Handle any errors
                console.error('Error filtering posts:', error);
                postsGrid.style.opacity = '1'; // Restore grid visibility
                postsGrid.style.pointerEvents = 'auto'; // Re-enable interactions
            });
        });
    });
});