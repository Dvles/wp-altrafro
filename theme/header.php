<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class('bg-paper text-ink font-metro'); ?>>

<header class="border-b border-black/10 sticky top-0 z-40 bg-white/85 backdrop-blur">
  <div class="wrapper flex items-center justify-between py-3">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="font-mono text-sm tracking-wide">ALT-R AFRO</a>
    <nav class="hidden md:flex gap-6 text-sm">
      <a href="#" class="hover:underline">MAGAZINE</a>
      <a href="#" class="hover:underline">PODCAST</a>
      <a href="#" class="hover:underline">RESSOURCES</a>
    </nav>
  </div>
</header>

<main class="wrapper py-8 md:py-12">
