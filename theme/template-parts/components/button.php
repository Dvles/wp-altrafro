<?php

/**
 * Button component
 * 
 * @package altr
 */

$url      = $args['url']      ?? '#';
$label    = $args['label']    ?? 'Click';
$position = $args['position'] ?? 'bottom_right';
$extra    = $args['classes']  ?? '';
$size    = $args['classes']  ?? '';

// Position classes
switch ($position) {
  case 'top_left':
    $position_classes = 'absolute left-[-1px] top-0 -translate-y-full';
    break;

  case 'bottom_right':
  default:
    $position_classes = 'absolute right-[-1px] bottom-0 translate-y-full';
    break;
}


// Position classes
switch ($size) {
  case 'small':
    $size_classes = 'text-xs';
    break;

  case 'medium':
  default:
    $size_classes = 'text-base';
    break;
}

?>


<a
  href="<?php echo esc_url($url); ?>"
  class="<?php echo esc_attr(trim($position_classes . ' ' . $extra. ' ' . $size_classes)); ?> bg-black text-white px-4 py-2  uppercase tracking-wide hover:bg-gray-800 transition">
  <?php echo esc_html($label); ?>
</a>