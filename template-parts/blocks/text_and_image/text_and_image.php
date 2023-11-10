<?php

/**
 * text_and_image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text_and_image-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'textAndImage';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults 
$text_and_image_alignment = get_field('text_and_image_alignment');
$text_and_image_layout = get_field('text_and_image_layout');
$text_and_image_main_title = get_field('text_and_image_main_title');
$text_and_image_main_title_hierarchy = get_field('text_and_image_main_title_hierarchy');
$text_title_alignment = get_field('text_and_image_main_title_alignment');
$text_and_image_eyebrow = get_field('text_and_image_eyebrow');
$text_and_image_title = get_field('text_and_image_title');
$title_size = get_field('title_size');
$copy_size = get_field('copy_size');
$text_and_image_copy = get_field('text_and_image_copy');
$text_and_image_regular = get_field('text_and_image_main_image');
$text_and_image_large = get_field('text_and_image_large_image');
$text_and_image_size = get_field('text_and_image_image_size');
$image_or_video = get_field('image_or_video');
$video_embed = get_field('video_embed');
$carousel_rows = get_field('image_carousel');
$round_images = get_field('round_or_rectanglar_images');
$text_and_image_button = get_field('text_and_image_button');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/text_and_image/text_and_image-prevsiew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php if( ($text_and_image_size  == 'fullwidth_image') || ($text_and_image_size  == 'secondary_image') ) { echo '-halfBg'; } ?> <?php if( $text_and_image_alignment  == 'image_right' ){ echo '-imageRight'; } ?> customBlock">

        <div class="textAndImage__container">

            <?php if (!empty($text_and_image_main_title)) { 
                // set heading level 
                $title_hierarchy_tag = '';
                if( $text_and_image_main_title_hierarchy  == 'text_image_h1' ){ $title_hierarchy_tag = 'h1'; } 
                elseif( $text_and_image_main_title_hierarchy  == 'text_image_h2' ){ $title_hierarchy_tag = 'h2'; } 
                elseif( $text_and_image_main_title_hierarchy  == 'text_image_h3' ){ $title_hierarchy_tag = 'h3'; } 
                elseif( $text_and_image_main_title_hierarchy  == 'text_image_h4' ){ $title_hierarchy_tag = 'h4'; } 
                elseif( $text_and_image_main_title_hierarchy  == 'text_image_h5' ){ $title_hierarchy_tag = 'h5'; } 
                elseif( $text_and_image_main_title_hierarchy  == 'text_image_h6' ){ $title_hierarchy_tag = 'h6'; } 
                else { $title_hierarchy_tag = 'p'; } 
 
                // set heading color 
                $text_image_title_color = '';
                if( !empty($text_color) ){ $text_image_title_color = '-customColor'; } ?>

                <div class="textAndImage__heading <?php 
                    if( $text_title_alignment == 'text_center' ) { echo 'textAlign_center'; } 
                    else if( $text_title_alignment == 'text_right' ) { echo 'textAlign_right'; } 
                    else {}?>">

                    <<?php echo $title_hierarchy_tag . ' class="textAndImage__mainTitle ' . $text_image_title_color . '"';?>>
                        <?php echo $text_and_image_main_title; ?>
                    </<?php echo $title_hierarchy_tag; ?>>
                </div>
            <?php } ?>

            <div class="textAndImage__cta <?php if( $text_and_image_alignment  == 'image_right' ){ echo '-imageRight'; } ?>">

                <div class="textAndImage__image <?php // these halves have opposite classes, meeting in the middle 
                    if( $text_and_image_layout == 'layout_3366' ) { echo '-oneThird'; } 
                    else if( $text_and_image_layout == 'layout_4060' ) { echo '-forty'; } 
                    else if( $text_and_image_layout == 'layout_5050' ) { echo '-oneHalf'; } 
                    else if( $text_and_image_layout == 'layout_6040' ) { echo '-sixty'; } 
                    else if( $text_and_image_layout == 'layout_6633' ) { echo '-twoThirds'; } 
                    else { /* nothing */ } ?>">

                    <?php // get either video, carousel, or image 
                    if( $image_or_video == 'video_embed' ) {
                        if (!empty($video_embed)) { ?>
                            <div class="textAndImage__video" data-no-autoplay>
                                <?php echo $video_embed; ?>
                            </div><?php 
                        } 

                     } else if( $image_or_video == 'img_carousel' ) {
                        if (!empty($carousel_rows)) { ?>
                            <div class="textAndImage__carouselContainer">
                                <div class="textAndImage__carousel" data-flickity='{ "wrapAround": true, "prevNextButtons": false, "selectedAttraction": 0.01, "friction": 0.15 }'>
                                    <?php if( $carousel_rows ) {
                                        foreach( $carousel_rows as $carousel_row ) {
                                            $carousel_row_image = $carousel_row['image_carousel_image']; 
                                            $carousel_alt_text = get_post_meta($carousel_row_image , '_wp_attachment_image_alt', true); ?> 

                                            <div class="textAndImage__carouselCell">
                                                <div class="textAndImage__carouselCellInner">
                                                    <div class="textAndImage__carouselImageWrap <?php if( $round_images == 'image_round' ){ echo '-circleImage'; } ?>">
                                                        <?php if (!empty($carousel_row_image)) { ?>
                                                            <div class="textAndImage__carouselImage">
                                                                <?php echo wp_get_attachment_image( $carousel_row_image, 'full', '', ['class'=> 'textAndImage__carouselImageImg','alt'=>$carousel_alt_text ]); ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div><?php 
                                        }
                                    } ?>
                                </div>
                            </div><?php 
                        } 

                     } else {
                        $main_image_alt_text = get_post_meta($text_and_image_regular , '_wp_attachment_image_alt', true); 

                        echo wp_get_attachment_image( $text_and_image_regular, 'full', '', ['class'=> 'textAndImage__img','alt'=>$main_image_alt_text]); 
                     } ?>
                </div>

                <div class="textAndImage__text <?php // these halves have opposite classes, meeting in the middle 
                    if( $text_and_image_layout == 'layout_3366' ) { echo '-twoThirds'; } 
                    else if( $text_and_image_layout == 'layout_4060' ) { echo '-sixty'; } 
                    else if( $text_and_image_layout == 'layout_5050' ) { echo '-oneHalf'; } 
                    else if( $text_and_image_layout == 'layout_6040' ) { echo '-forty'; } 
                    else if( $text_and_image_layout == 'layout_6633' ) { echo '-oneThird'; } 
                    else { /* nothing */ } ?>">

                    <?php if (!empty($text_and_image_eyebrow)) { ?>
                        <div class="textAndImage__eyebrow <?php if(!empty($text_color)){echo '-customColor';}?>"><span class="textAndImage__eyebrowText"><?php echo $text_and_image_eyebrow; ?></span></div>
                    <?php } ?>

                    <?php if (!empty($text_and_image_title)) { ?>
                        <h2 class="textAndImage__title <?php if(!empty($text_color)){echo '-customColor';}?> <?php if( $title_size == 'small_title' ){ echo '-smallTitle'; } ?>"><?php echo $text_and_image_title; ?></h2>
                    <?php } ?>

                    <?php if (!empty($text_and_image_copy)) { ?>
                        <div class="textAndImage__copy <?php if(!empty($text_color)){echo '-customColor';}?> <?php if( $copy_size == 'large_copy' ){ echo '-largeCopy'; } ?>">
                            <?php echo $text_and_image_copy; ?>

                            <?php if ($text_and_image_button) {
                                $cta_link_one_url = $text_and_image_button['url'];
                                $cta_link_one_title = $text_and_image_button['title'];
                                $cta_link_one_target = $text_and_image_button['target'] ? $text_and_image_button['target'] : '_self'; ?>
                                <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                             <?php } ?>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>

        <?php if( ($text_and_image_size  == 'fullwidth_image') || ($text_and_image_size  == 'secondary_image') ){ ?>
            <div class="textAndImage__imageHalfBg">
                <?php if (!empty($text_and_image_large)) { ?>
                    <?php echo wp_get_attachment_image( $text_and_image_large, 'full', '', ['class'=> 'textAndImage__imgHalfBg','alt'=>$text_and_image_title]); ?>
                <?php } else { ?>
                    <?php echo wp_get_attachment_image( $text_and_image_regular, 'full', '', ['class'=> 'textAndImage__imgHalfBg','alt'=>$text_and_image_title]); ?>
                <?php } ?>
            </div>
            <div class="theLine"></div>
        <?php } ?>

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
