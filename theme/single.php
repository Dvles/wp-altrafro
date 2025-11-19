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
                class="w-full h-auto object-cover"
            />
        </figure>
    </div>
</section>
<?php endif; ?>

<!-- ARTICLE BODY + SIDEBAR -->
<section class="page-grid mt-20">
    <!-- Sidebar -->
    <div class="md:hidden lg:block col-start-2 col-end-4 lg:col-start-2 lg:col-end-4 mb-8 lg:mb-0">
        <?php get_template_part('template-parts/components/article-sidebar'); ?>
    </div>

    <!-- Content -->
    <div class="col-start-3 col-end-11 lg:col-start-4 lg:col-end-10 article-content global-padding-sides">
        
        <!-- INTRO -->
        <?php if ($introText) : ?>
            <p class="text-lg leading-relaxed font-light mb-12">
                <?php echo esc_html($introText); ?>
            </p>
        <?php endif; ?>

        <!-- MAIN CONTENT -->
        <?php if ($mainContent) : ?>
            <div class="prose">
                <?php echo $mainContent; ?>
            </div>
        <?php endif; ?>

        <!-- OUTRO -->
        <?php if ($outroText) : ?>
            <p class="text-lg leading-relaxed mt-12">
                <?php echo esc_html($outroText); ?>
            </p>
        <?php endif; ?>

    </div>

    <!-- Ad placement -->
    <div class="md:hidden lg:block lg:col-start-11 lg:col-end-13 mt-96">
        <!-- placeholder -->
    </div>
</section>

<?php get_footer(); ?>