<?php

/**
 * Sticky article sidebar
 *
 * @package altr
 */

$post_id = get_the_ID();

// Author 
$author_id   = get_post_field( 'post_author', $post_id );
$author_name = $author_id
    ? get_the_author_meta( 'display_name', $author_id )
    : '';

// Reading time 
$reading_time = function_exists('altr_get_reading_time')
  ? altr_get_reading_time($post_id)
  : '';

// Tags (limit 4)
$tags = get_the_tags();


$url   = urlencode(get_permalink($post_id));
$title = urlencode(get_the_title($post_id));
?>

<aside class="lg:sticky lg:top-24 text-xs uppercase font-mono leading-tight global-padding-sides">
  <div class="flex flex-col gap-4">

    <!-- SOCIAL -->
    <div class="flex flex-row flex-wrap gap-3">
      <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>"
        target="_blank" rel="noopener noreferrer"
        class="hover:bg-hypergreen">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 18 18"
          class="w-6 h-6 text-black transition hover:opacity-50">
          <rect x="0" y="0" width="18" height="18" rx="2" ry="2" />
        </svg>


      </a>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
        target="_blank" rel="noopener noreferrer"
        class="hover:bg-hypergreen -mx-1 px-1">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 18 18"
          class="w-6 h-6 text-black transition hover:opacity-50">
          <rect x="0" y="0" width="18" height="18" rx="2" ry="2" />
        </svg>


      </a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>"
        target="_blank" rel="noopener noreferrer"
        class="hover:bg-hypergreen -mx-1 px-1">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 18 18"
          class="w-6 h-6 text-black transition hover:opacity-50">
          <rect x="0" y="0" width="18" height="18" rx="2" ry="2" />
        </svg>


      </a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>"
        target="_blank" rel="noopener noreferrer"
        class="hover:bg-hypergreen -mx-1 px-1">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 18 18"
          class="w-6 h-6 text-black transition hover:opacity-50">
          <rect x="0" y="0" width="18" height="18" rx="2" ry="2" />
        </svg>


      </a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>"
        target="_blank" rel="noopener noreferrer"
        class="hover:bg-hypergreen -mx-1 px-1">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 18 18"
          class="w-6 h-6 text-black transition hover:opacity-50">
          <rect x="0" y="0" width="18" height="18" rx="2" ry="2" />
        </svg>


      </a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>"
        target="_blank" rel="noopener noreferrer"
        class="hover:bg-hypergreen -mx-1 px-1">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 18 18"
          class="w-6 h-6 text-black transition hover:opacity-50">
          <rect x="0" y="0" width="18" height="18" rx="2" ry="2" />
        </svg>


      </a>
      <!-- you can add a “copy link” button later with JS -->
    </div>


    <!-- AUTHOR -->
    <div>
      <p class="mb-1 text-gray-500">BY <?php echo esc_html($author_name); ?></p>
    </div>

    <!-- READING TIME -->
    <?php if ($reading_time) : ?>
      <div>
        <p class="mb-1 text-gray-500"><?php echo esc_html($reading_time); ?> READ</p>
      </div>
    <?php endif; ?>

    <!-- TAGS -->
    <?php if ($tags) : ?>
      <div class="flex flex-col gap-2">
        <?php
        $count = 0;
        foreach ($tags as $tag) {
          if ($count >= 4) break;

          $tag_link  = esc_url(get_tag_link($tag->term_id));
          $tag_label = '#' . esc_html(strtoupper($tag->name));

          echo '
            <a href="' . $tag_link . '" class="group w-fit">
              <span class="inline-block border-b border-black group-hover:bg-hypergreen">
                ' . $tag_label . '
              </span>
            </a>';
          $count++;
        }
        ?>
      </div>
    <?php endif; ?>

  </div>
</aside>