<?php

get_header();

$title             = get_the_title();
$seriesDescription = get_field('series_description');
$heroMedia         = get_field('hero_media'); // flexible (image or video)
$endImage          = get_field('end_image');  // final image at end
?>

<!-- FEATURED IMAGE (blog-style card, if you still want it) -->
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
        'type' => 'post',
    ]
);
?>

<!-- HERO MEDIA (image OR video, using ACF flexible field) -->
<section class="page-grid mb-12 lg:mb-16">
  <div class="col-start-3 col-end-11 lg:col-start-2 lg:col-end-10">
    <?php if ($heroMedia) : ?>
      <?php foreach ($heroMedia as $block) : ?>

        <?php if ($block['acf_fc_layout'] === 'image' && !empty($block['image'])) : ?>
          <figure class="w-full">
            <img
              src="<?php echo esc_url($block['image']['url']); ?>"
              alt="<?php echo esc_attr($block['image']['alt']); ?>"
              class="w-full h-auto object-cover"
            />
            <?php if (!empty($block['image']['caption'])) : ?>
              <figcaption class="mt-2 text-[11px] uppercase font-mono">
                <?php echo esc_html($block['image']['caption']); ?>
              </figcaption>
            <?php endif; ?>
          </figure>

        <?php elseif ($block['acf_fc_layout'] === 'video' && !empty($block['video'])) : ?>
          <figure class="w-full">
            <video
              class="w-full h-auto"
              autoplay
              muted
              loop
              playsinline
            >
              <source src="<?php echo esc_url($block['video']['url']); ?>" type="video/mp4">
            </video>
            <?php if (!empty($block['video']['title'])) : ?>
              <figcaption class="mt-2 text-[11px] uppercase font-mono">
                <?php echo esc_html($block['video']['title']); ?>
              </figcaption>
            <?php endif; ?>
          </figure>
        <?php endif; ?>

      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- ARTICLE BODY + SIDEBAR -->
<section class="page-grid mt-20 ">
  <!-- Sidebar -->
  <div class="col-start-2 col-end-4 lg:col-start-2 lg:col-end-4 mb-8 lg:mb-0">
    <?php get_template_part('template-parts/components/article-sidebar'); ?>
  </div>

  <!-- Content -->
  <div class="col-start-4 col-end-12 lg:col-start-4 lg:col-end-10 article-content global-padding-sides">
    <?php
    while (have_posts()) :
      the_post();
      the_content();
    endwhile;
    ?>
  </div>

  <!-- Ad placement / promo -->
  <div class="col-start-11 col-end-13 lg:col-start-11 lg:col-end-13 mt-96">
    xxx<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
</section>

<!-- FINAL IMAGE -->
<?php if ($endImage) : ?>
  <section class="h-screen-80 page-grid bg-slate-500 z-30 flex pb-20 items-end lg:pb-0 lg:items-center">
    <div class="col-start-3 col-end-11 lg:col-start-2 lg:col-end-6">
      <figure class="w-full">
        <img
          src="<?php echo esc_url($endImage['url']); ?>"
          alt="<?php echo esc_attr($endImage['alt']); ?>"
          class="w-full h-auto object-cover"
        />
        <?php if (!empty($endImage['caption'])) : ?>
          <figcaption class="mt-2 text-[11px] uppercase font-mono text-right">
            <?php echo esc_html($endImage['caption']); ?>
          </figcaption>
        <?php endif; ?>
      </figure>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
