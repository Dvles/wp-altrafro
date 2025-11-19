// block-styles.js
wp.domReady(function () {
  
  // =========================
  // CUSTOM ICONS
  // =========================
  
  // Intro icon - pilcrow with hypergreen background
  const introIcon = wp.element.createElement('svg', 
    { width: 24, height: 24, viewBox: '0 0 24 24', fill: 'none' },
    [
      // Green background
      wp.element.createElement('rect', { 
        key: 'bg',
        x: 2, y: 2, width: 20, height: 20, rx: 4,
        fill: '#00ff88'
      }),
      // Pilcrow ¶
      wp.element.createElement('path', { 
        key: 'pilcrow',
        d: 'M13 4v16M17 4v16M10.5 4C8.01 4 6 6.01 6 8.5S8.01 13 10.5 13H13',
        stroke: '#000',
        strokeWidth: 1.5,
        strokeLinecap: 'round',
        strokeLinejoin: 'round',
        fill: 'none'
      })
    ]
  );

  // Outro icon - pilcrow with grey background
  const outroIcon = wp.element.createElement('svg', 
    { width: 24, height: 24, viewBox: '0 0 24 24', fill: 'none' },
    [
      // Grey background
      wp.element.createElement('rect', { 
        key: 'bg',
        x: 2, y: 2, width: 20, height: 20, rx: 4,
        fill: '#e5e5e5'
      }),
      // Pilcrow ¶
      wp.element.createElement('path', { 
        key: 'pilcrow',
        d: 'M13 4v16M17 4v16M10.5 4C8.01 4 6 6.01 6 8.5S8.01 13 10.5 13H13',
        stroke: '#000',
        strokeWidth: 1.5,
        strokeLinecap: 'round',
        strokeLinejoin: 'round',
        fill: 'none'
      })
    ]
  );

  // =========================
  // BLOCK VARIATIONS
  // =========================
  
  wp.blocks.registerBlockVariation('core/paragraph', {
    name: 'intro-paragraph',
    title: 'Intro Paragraph',
    description: 'Opening paragraph with larger text',
    icon: introIcon,
    keywords: ['intro', 'opening', 'lead', 'introduction'],
    attributes: {
      className: 'is-style-intro',
    },
    scope: ['inserter', 'transform'],
    isActive: (blockAttributes) => 
      blockAttributes.className?.includes('is-style-intro'),
  });

  wp.blocks.registerBlockVariation('core/paragraph', {
    name: 'outro-paragraph',
    title: 'Outro Paragraph',
    description: 'Closing paragraph',
    icon: outroIcon,
    keywords: ['outro', 'closing', 'conclusion', 'end'],
    attributes: {
      className: 'is-style-outro',
    },
    scope: ['inserter', 'transform'],
    isActive: (blockAttributes) => 
      blockAttributes.className?.includes('is-style-outro'),
  });

  // =========================
  // BLOCK STYLES
  // =========================
  
  wp.blocks.registerBlockStyle('core/paragraph', {
    name: 'intro',
    label: 'Intro',
  });

  wp.blocks.registerBlockStyle('core/paragraph', {
    name: 'outro',
    label: 'Outro',
  });

  wp.blocks.registerBlockStyle('core/quote', {
    name: 'tweetable',
    label: 'Tweetable Quote',
  });

  wp.blocks.registerBlockStyle('core/image', {
    name: 'caption-right',
    label: 'Caption Right',
  });

});