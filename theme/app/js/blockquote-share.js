document.addEventListener('DOMContentLoaded', function() {
  // Find all blockquotes in article content
  const blockquotes = document.querySelectorAll('.article-body > blockquote, .article-body > figure.wp-block-quote blockquote');
  
  blockquotes.forEach(function(blockquote) {
    // Create share button
    const shareBtn = document.createElement('button');
    shareBtn.className = 'blockquote-share';
    shareBtn.textContent = 'Share';
    shareBtn.setAttribute('aria-label', 'Share this quote');
    
    // Get quote text
    const quoteText = blockquote.textContent.trim();
    const pageUrl = window.location.href;
    const pageTitle = document.title;
    
    // Click handler
    shareBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Try native share API first (mobile)
      if (navigator.share) {
        navigator.share({
          text: `"${quoteText}" — ${pageTitle}`,
          url: pageUrl
        }).catch(() => {
          // Fallback if user cancels
        });
      } else {
        // Fallback to Twitter
        const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent('"' + quoteText + '"')}&url=${encodeURIComponent(pageUrl)}`;
        window.open(twitterUrl, '_blank', 'width=550,height=420');
      }
    });
    
    // Add button to blockquote
    blockquote.style.position = 'relative';
    blockquote.appendChild(shareBtn);
  });
});