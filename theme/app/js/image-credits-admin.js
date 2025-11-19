// app/js/admin-image-credits.js
(function ($) {
  // If PHP didn’t pass anything, bail early
  if (!window.altrImageCredits || !altrImageCredits.missingIds.length) {
    return;
  }

  const missingIds = altrImageCredits.missingIds;

  /**
   * 1) Warning popup on Publish / Update
   */
  $(function () {
    const $publish = $('#publish');

    if ($publish.length) {
      $publish.on('click', function (e) {
        if (!window.confirm(altrImageCredits.warning)) {
          e.preventDefault();
          e.stopPropagation();
        }
      });
    }
  });

  /**
   * 2) Red overlay + tooltip in the ACF WYSIWYG editor
   */
  function markImagesInEditor() {
    // ACF WYSIWYG ID: acf + field key (here: field_main_content)
    const editorId = 'acf-field_main_content';

    if (window.tinymce && tinymce.get(editorId)) {
      const ed = tinymce.get(editorId);

      const applyMarks = () => {
        const $body = $(ed.getBody());

        $body.find('img').each(function () {
          const cls = this.className || '';
          const match = cls.match(/wp-image-(\d+)/);
          if (!match) return;

          const id = parseInt(match[1], 10);
          if (!missingIds.includes(id)) return;

          $(this)
            .addClass('altr-image-missing-credit')
            .attr(
              'title',
              'Add photo credits in the media details – image is hidden on the site until credited.'
            );
        });
      };

      // Run on various TinyMCE events
      ed.on('Load', applyMarks);
      ed.on('SetContent', applyMarks);
      ed.on('Change', applyMarks);

      // And once immediately, in case it’s already loaded
      applyMarks();
    }
  }

  // TinyMCE might init after DOMReady → poll for a bit
  let tries = 0;
  const interval = setInterval(function () {
    tries++;
    if (window.tinymce) {
      markImagesInEditor();
      clearInterval(interval);
    }
    if (tries > 20) clearInterval(interval);
  }, 500);
})(jQuery);
