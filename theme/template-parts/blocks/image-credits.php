<?php
/**
 * Image with Credit Block
 *
 * @package altr
 */

$image        = get_field('block_image');
$photographer = get_field('block_photographer');
$title        = get_field('block_artwork_title');
$year         = get_field('block_year');
$source       = get_field('block_source');

$align_class = isset($block['align']) ? 'align' . $block['align'] : '';

if (!$image) {
    echo '<p class="text-gray-400 italic p-4 border border-dashed">Select an image and add photographer credit.</p>';
    return;
}

// Build credit
$parts = [];
if ($title) {
    $parts[] = '<em>' . esc_html($title) . '</em>';
}
if ($photographer) {
    $parts[] = '© ' . esc_html($photographer);
}
if ($year) {
    $parts[] = esc_html($year);
}
$credit = implode(', ', $parts);

if ($source && $credit) {
    $credit = '<a href="' . esc_url($source) . '" target="_blank" rel="noopener">' . $credit . '</a>';
}
?>

<figure class="wp-block-image <?php echo esc_attr($align_class); ?>">
    <img 
        src="<?php echo esc_url($image['url']); ?>" 
        alt="<?php echo esc_attr($image['alt']); ?>"
        class="w-full h-auto"
    />
    <?php if ($credit) : ?>
        <figcaption class="text-[11px] font-mono mt-2 text-right">
            <?php echo $credit; ?>
        </figcaption>
    <?php endif; ?>
</figure>