<?php

/**
 * Video Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'videoBlock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'videoBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults 
$video_title = get_field('video_title');
$video_description = get_field('video_description');
$video_embed = get_field('video_embed');
$video_background_image = get_field('video_background_image');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/video/video-previsew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
            
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <?php if (!empty($video_title) || !empty($video_description)) { ?>
            <div class="videoBlock__text container">
                <?php if (!empty($video_title)) { ?>
                    <h2 class="videoBlock__title"><?php echo $video_title; ?></h2>
                <?php } ?>

                <?php if (!empty($video_description)) { ?>
                    <div class="videoBlock__description"><?php echo $video_description; ?></div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="videoBlock__embed container">
            <div class="videoBlock__embed-wrapper" data-no-autoplay>
                <?php echo $video_embed; ?>
            </div>
        </div>

        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $top_bottom_padding || $video_background_image)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

                    // background image 
                    if (!empty($video_background_image)) { 
                        echo 'background-image: url(' . $video_background_image . ');'; } 

                    if (!empty($background_color)) {
                        echo 'background-color: ' . $background_color . ';'; }
                        
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
