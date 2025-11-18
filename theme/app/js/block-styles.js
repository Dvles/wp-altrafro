wp.domReady(function () {

  // Intro Paragraph
  wp.blocks.registerBlockStyle('core/paragraph', {
    name: 'intro',
    label: 'Intro Paragraph',
  });

  // body Paragraph
  wp.blocks.registerBlockStyle('core/paragraph', {
    name: 'body',
    label: 'body Paragraph',
  });

  // Outro Paragraph
  wp.blocks.registerBlockStyle('core/paragraph', {
    name: 'outro',
    label: 'Outro Paragraph',
  });

  // Quote With Tweet
  wp.blocks.registerBlockStyle('core/quote', {
    name: 'tweetable',
    label: 'Tweetable Quote',
  });

  // Right-Aligned Caption Image
  wp.blocks.registerBlockStyle('core/image', {
    name: 'caption-right',
    label: 'Caption Right',
  });

});
