<?php
get_header();

$title             = get_the_title();
$seriesDescription = get_field('series_description');
$heroImage         = get_field('hero_image');
$introText         = get_field('intro_text');
$mainContent       = get_field('main_content');
$outroText         = get_field('outro_text');
?>

<!-- FEATURED IMAGE -->
<section class="h-screen-80 page-grid bg-slate-500 z-30 flex pb-20 items-end lg:pb-0 lg:items-center">
  <div class="col-start-3 col-end-11 lg:col-start-2 lg:col-end-6">
    <?php get_template_part('template-parts/cards/card-featured'); ?>
  </div>
</section>

<!-- PAGE HEADER -->
<?php
get_template_part(
  'template-parts/layouts/page-header',
  null,
  [
    'heading'    => $title,
    'subheading' => $seriesDescription,
    'filters'    => '',
    'type'       => 'post',
  ]
);
?>

<!-- HERO MEDIA -->
<?php if ($heroImage) : ?>
  <section class="page-grid mb-12 lg:mb-16">
    <div class="col-start-3 col-end-11 lg:col-start-2 lg:col-end-10">
      <figure class="w-full">
        <img
          src="<?php echo esc_url($heroImage['url']); ?>"
          alt="<?php echo esc_attr($heroImage['alt']); ?>"
          class="w-full h-auto object-cover" />
      </figure>
    </div>
  </section>
<?php endif; ?>

<!-- SECTION 1: SIDEBAR + INTRO -->
<section class="page-grid mt-20">
    <!-- Sidebar -->
    <div class="hidden lg:block lg:col-start-2 lg:col-end-4">
        <?php get_template_part('template-parts/components/article-sidebar'); ?>
    </div>

    <!-- Intro -->
    <div class="col-start-2 col-end-12 lg:col-start-4 lg:col-end-10">
        <?php if ($introText) : ?>
            <p class="is-style-intro">
                <?php echo esc_html($introText); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- SECTION 2: MAIN CONTENT + ADS -->
<section class="page-grid">
    <!-- Main Content - full width cols 2-10 -->
    <div class="col-start-2 col-end-12 lg:col-start-2 lg:col-end-10 article-content">
        <?php if ($mainContent) : ?>
            <div class="article-body">
                <?php echo apply_filters('the_content', $mainContent); ?>
            </div>
        <?php endif; ?>

        <?php if ($outroText) : ?>
            <p class="is-style-outro">
                <?php echo esc_html($outroText); ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Ad placement -->
    <div class="hidden lg:block lg:col-start-11 lg:col-end-13 lg:sticky lg:top-24 lg:self-start">
        <!-- placeholder -->
    </div>
</section>

<?php get_footer(); ?>