<?php

/**
 * Featured Posts Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'featuredPosts-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'featuredPosts';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$featured_posts_title = get_field('featured_posts_title') ?: 'Default title';
$featured_post_excerpts = get_field('featured_post_excerpts');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');


// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/featured_posts/featured_posts-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="featuredPosts__container">

            <?php if (!empty($featured_posts_title)) { ?>
                <h4 class="featuredPosts__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $featured_posts_title; ?></h4>
            <?php } ?>

            <div class="featuredPosts__inner">
                <?php
                global $post;
                    $recentPosts = new WP_Query(array(
                        'showposts' => 3, // Number of posts to pull
                        'offset' => 0,  // Set this to 1 to skip over first post, 2 to skip the first two, etc.
                        'order' => 'DESC', // Puts new posts first, to put oldest posts first, change to 'ASC'
                        'post__not_in' => get_option("sticky_posts"), // Ignore sticky posts for this particular query
                    ));

                    while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>

                        <div class="featuredPosts__block">
                            <div class="featuredPosts__blockBorder -hasLink">

                                <div class="featuredPosts__blockThumb">
                                    <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

                                    <?php if ( ! empty($thumb) ) : ?>
                                        <img class="featuredPosts__blockThumbImg" src="<?php echo $thumb['0'];?>" alt="<?php echo get_the_title(); ?>">
                                    <?php else : ?>
                                        <img class="featuredPosts__blockThumbImg" src="<?php echo get_template_directory_uri()?>/assets/dist/img/fallback.jpg" alt="<?php echo get_the_title();?>">
                                    <?php endif; ?>
                                </div>

                                <div class="featuredPosts__blockTextWrap">
                                    <div class="featuredPosts__blockEyebrow <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php the_category(', '); ?>
                                    </div>
                                    <div class="featuredPosts__blockTitle <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo get_the_title(); ?>
                                    </div>
                                    <?php if( $featured_post_excerpts == 'hide_excerpts' ) { 
                                        // post excerpt hidden 
                                    } else { ?>
                                        <div class="featuredPosts__blockText <?php if(!empty($text_color)){echo '-customColor';}?>">
                                            <?php echo get_the_excerpt(); ?>
                                        </div><?php 
                                    } ?>
                                </div>

                                <a class="featuredPosts__blockLink <?php if(!empty($text_color)){echo '-customColor';}?>" href="<?php echo get_permalink( get_the_ID() );?>">Read more</a>
                            </div>
                        </div>

                        <?php // get_template_part('template-parts/blog-featured-post-card'); // post featured image, title, date, read time, and link
                    endwhile; 

                wp_reset_postdata(); ?>
            </div>
        </div>



        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $top_bottom_padding)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

                    if (!empty($background_color)) {
                        echo 'background: ' . $background_color . ';'; }

                    if (!empty($text_color)) {
                        echo 'color: ' . $text_color . ';'; }

                    if( $top_bottom_padding == 'bottom_only' ) { 
                        echo 'padding-top: 1px'; } 

                    else if( $top_bottom_padding == 'top_only' ) { 
                        echo 'padding-bottom: 1px'; } 

                    else if( $top_bottom_padding == 'no_margin' ) { 
                        echo 'padding: 1px 0'; } 

                    else { } ?>
                }
            </style>
        <?php } ?>

    </div>

<?php } ?>
