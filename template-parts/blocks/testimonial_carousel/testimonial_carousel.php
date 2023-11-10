<?php

/**
 * testimonialCarousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonialCarousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'testimonialCarousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$rows = get_field('testimonial_carousel_block');
$testimonialCarousel_dot_position = get_field('testimonial_carousel_dot_position');
$testimonial_carousel_title = get_field('testimonial_carousel_title');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/testimonial_carousel/testimonial_carousel-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
            
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php if(!empty($background_color)){echo '-customColor';} ?> <?php if ( $testimonialCarousel_dot_position == 'dots_above' ) {echo 'top-dots';} ?> customBlock">

        <?php if (!empty($testimonial_carousel_title)) { ?>
            <div class="container">
                <h4 class="testimonialCarousel__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $testimonial_carousel_title; ?></h4>
            </div>
        <?php } ?>

        <div class="testimonialCarousel__container">
            <div class="testimonialCarousel__carousel" data-flickity='{ "wrapAround": true, "selectedAttraction": 0.01, "friction": 0.15 }'>

                <?php if( $rows ) {
                    foreach( $rows as $row ) {
                        $testimonialCarousel_text = $row['testimonial_text'];
                        $testimonialCarousel_author = $row['testimonial_author'];
                        $testimonialCarousel_author_role = $row['testimonial_author_role']; ?> 

                        <div class="testimonialCarousel__carouselCell">
                            <blockquote class="testimonialCarousel__blockquote">
                                <div class="testimonialCarousel__blockquoteInner">
                                    <?php if (!empty($testimonialCarousel_text)) { ?>
                                        <div class="testimonialCarousel__testimonial">
                                            <?php echo $testimonialCarousel_text; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="testimonialCarousel__attribution">
                                        <?php if (!empty($testimonialCarousel_author)) { ?>
                                            <span class="testimonialCarousel__author">
                                                <?php echo $testimonialCarousel_author; ?>
                                            </span>
                                        <?php } ?>
                                        <?php if (!empty($testimonialCarousel_author_role)) { ?>
                                            <span class="testimonialCarousel__role">
                                                <?php echo $testimonialCarousel_author_role; ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </blockquote>
                        </div><?php 
                    }
                } ?>
            </div>
        </div>

        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

                    // full div background color, using stripe style below for this block 
                    if (!empty($background_color)) {
                        echo 'background: ' . $background_color . ';'; }

                    if (!empty($text_color)) {
                        echo 'color: ' . $text_color . ';'; } ?> 
                }
            </style>
        <?php } ?>

    </div>

<?php } ?>
