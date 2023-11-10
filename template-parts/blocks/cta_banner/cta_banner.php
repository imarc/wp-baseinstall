<?php

/**
 * CTA Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ctaBanner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ctaBanner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
// $eyebrow = get_field('cta_banner_eyebrow');
$title = get_field('cta_banner_title') ?: 'Your title here ...';
$emphasis = get_field('cta_banner_title_emphasis');

$cta_banner_button_or_form = get_field('cta_banner_button_or_form');
$cta_button = get_field('cta_banner_button');
$cta_banner_form = get_field('cta_banner_form');

$cta_color_and_layout = get_field('cta_banner_layout');

$cta_background_image = get_field('cta_background_image');



// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/cta_banner/cta_banner-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php 
        if( $cta_color_and_layout == 'cta_narrow' ) { 
        echo ' -cta_narrow'; } 
        else if( $cta_color_and_layout == 'cta_slim' ) { 
        echo ' -cta_slim'; } 
        else {/* nothing */} 

        if( $cta_banner_button_or_form == 'cta_form' ) { 
        echo ' -cta_has_form'; } ?> <?php if(!empty($background_color)){echo '-customBgColor';}?> customBlock">

        <div class="ctaBanner__container">

            <div class="ctaBanner__block">
                <div class="ctaBanner__inner">

                    <div class="ctaBanner__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $title; ?> <?php if (!empty($emphasis)) { ?><span class="-emphasis"><?php echo $emphasis; ?></span><?php } ?></div>



                    <?php if (!empty($cta_banner_form)) { ?>
                        <div class="ctaBanner__form">
                            <?php echo $cta_banner_form; ?>
                        </div>
                    <?php } ?>




                    <?php if( $cta_button ): 
                        $cta_link_one_url = $cta_button['url'];
                        $cta_link_one_title = $cta_button['title'];
                        $cta_link_one_target = $cta_button['target'] ? $cta_button['target'] : '_self';
                        ?>
                        <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                    <?php endif; ?>


                </div>
                
            </div>
        </div>



        <?php // color and padding options from WP block editor - due to the variable width and alignment for this block in the comp, styles are applied to the 'ctaBanner__block' element, and the usual padding has been replaced with margins that only apply to the narrow-spaced option 
            if (!empty($background_color || $text_color || $top_bottom_padding || $cta_background_image)) { ?>
            <style type="text/css">
                <?php echo '#' . $id . ' .' . $className . '__block'; ?> { <?php

                    // background image 
                    if (!empty($cta_background_image)) { 
                        echo 'background-image: url(' . $cta_background_image . ');'; } 

                    if (!empty($background_color)) {
                        echo 'background-color: ' . $background_color . ';'; }

                    if (!empty($text_color)) {
                        echo 'color: ' . $text_color . ';'; }

                    if( $top_bottom_padding == 'bottom_only' ) { 
                        echo 'margin-top: 1px'; } 

                    else if( $top_bottom_padding == 'top_only' ) { 
                        echo 'margin-bottom: 1px'; } 

                    else if( $top_bottom_padding == 'no_margin' ) { 
                        echo 'margin: 1px 0'; } 

                    else { } ?> 
                }
            </style>
        <?php } ?>


    </div>

<?php } ?>
