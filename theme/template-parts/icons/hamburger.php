<?php
$icon_path = get_template_directory() . '/template-parts/icons/hamburger.svg';
$class = isset($args['class']) ? $args['class'] : '';

if (file_exists($icon_path)) {
  $svg = file_get_contents($icon_path);
  // Add class to SVG if provided
  if ($class) {
    $svg = str_replace('<svg', '<svg class="' . esc_attr($class) . '"', $svg);
  }
  echo $svg;
}
?>