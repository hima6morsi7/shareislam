<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package Newsium
 */

$excerpt_length = 20;
global $post;
$url = newsium_get_freatured_image_url($post->ID, 'newsium-medium');
$show_excerpt = 'true';

$class = '';
$background = '';
if ($url != '') {
    $class = 'data-bg read-img read-bg-img data-bg-categorised';
    $background = $url;
}
?>

<div class="archive-grid-post">
    <div class="read-single color-pad">
        <div class="data-bg read-img pos-rel read-bg-img"
             data-background="<?php echo esc_url($url); ?>">
            <img src="<?php echo esc_url($url); ?>">
            <div class="read-categories af-category-inside-img">
                <?php echo newsium_post_format($post->ID); ?>
                <?php newsium_post_categories(); ?>
            </div>
            <span class="min-read-post-format">
                <?php newsium_count_content_words($post->ID); ?>
            </span>
            <a href="<?php the_permalink(); ?>"></a>
        </div>
        <div class="read-details color-tp-pad no-color-pad">

            <div class="read-title">
                <h4>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            </div>
            <div class="entry-meta">
                <?php newsium_post_item_meta(); ?>
            </div>
        </div>
    </div>

    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'newsium'),
        'after' => '</div>',
    ));
    ?>
</div>








