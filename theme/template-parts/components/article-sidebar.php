<?php
/**
 * Sticky article sidebar
 *
 * @package altr
 */

$post_id = get_the_ID();

// Author
$author_name = get_the_author();

// Reading time (helper we’ll add below)
$reading_time = function_exists('altr_get_reading_time')
    ? altr_get_reading_time($post_id)
    : '';

// Tags (limit 4)
$tags = get_the_tags();

// Optional: use your existing helpers
$artist = function_exists('altr_get_artist') ? altr_get_artist($post_id) : '';
?>

<aside class="lg:sticky lg:top-24 space-y-6 text-xs uppercase font-mono leading-tight">

  <?php if ($artist) : ?>
    <div>
      <p class="mb-1 text-gray-500">ARTIST</p>
      <p><?php echo esc_html($artist); ?></p>
    </div>
  <?php endif; ?>

  <div>
    <p class="mb-1 text-gray-500">AUTHOR</p>
    <p><?php echo esc_html($author_name); ?></p>
  </div>

  <?php if ($reading_time) : ?>
    <div>
      <p class="mb-1 text-gray-500">READ</p>
      <p><?php echo esc_html($reading_time); ?></p>
    </div>
  <?php endif; ?>

  <?php if ($tags) : ?>
    <div>
      <p class="mb-1 text-gray-500">POPULAR TAGS</p>
      <div class="flex flex-wrap gap-2">
        <?php
        $count = 0;
        foreach ($tags as $tag) {
          if ($count >= 4) break;
          echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="border-b border-black hover:bg-hypergreen px-1">'
              . '#' . esc_html(strtoupper($tag->name)) . '</a>';
          $count++;
        }
        ?>
      </div>
    </div>
  <?php endif; ?>

  <div>
    <p class="mb-1 text-gray-500">SHARE</p>
    <div class="flex flex-col gap-1">
      <?php
      $url   = urlencode(get_permalink($post_id));
      $title = urlencode(get_the_title($post_id));
      ?>
      <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>"
         target="_blank" rel="noopener noreferrer"
         class="hover:bg-hypergreen -mx-1 px-1">
        Twitter
      </a>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
         target="_blank" rel="noopener noreferrer"
         class="hover:bg-hypergreen -mx-1 px-1">
        Facebook
      </a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>"
         target="_blank" rel="noopener noreferrer"
         class="hover:bg-hypergreen -mx-1 px-1">
        LinkedIn
      </a>
      <!-- you can add a “copy link” button later with JS -->
    </div>
  </div>

</aside>
