<?php

/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$hero_style = get_field('hero_style');
$hero_title = get_field('hero_title');
$hero_text = get_field('hero_text');
$cta_primary_link = get_field('hero_cta_primary_button');
$hero_image = get_field('hero_image');
$hero_shape = get_field('hero_shape');
$hero_background_image = get_field('hero_background_image');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
// $top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/hero/hero-previsew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); if ($hero_style == 'hero_featured') {echo ' -featured';} elseif ($hero_style == 'hero_homepage') {echo ' -homepage';} elseif ($hero_style == 'hero_centered_text_card') {echo ' -centeredCard';}?>">

        <div class="hero__cta">

            <div class="hero__text <?php if ($hero_style == 'hero_centered_text_card') {echo ' -centeredCard';}?>">
                <?php if (!empty($hero_title)) { ?>
                    <h1 class="hero__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $hero_title; ?></h1>
                <?php } ?>

                <?php if (!empty($hero_text)) { ?>
                    <p class="hero__copy"><?php echo $hero_text; ?></p>
                <?php } ?>

                <?php if ($cta_primary_link) {
                    $cta_link_one_url = $cta_primary_link['url'];
                    $cta_link_one_title = $cta_primary_link['title'];
                    $cta_link_one_target = $cta_primary_link['target'] ? $cta_primary_link['target'] : '_self'; ?>
                    <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                 <?php } ?>
            </div>

            <?php if (!empty($hero_image)) { ?>
                <div class="hero__image">
                    <?php echo wp_get_attachment_image( $hero_image, 'full', '', ['class'=> 'hero__image','alt'=>$hero_title]); ?>
                </div>
            <?php } ?>

        </div>

        <div class="hero__shape">
            <?php echo wp_get_attachment_image( $hero_shape, 'full', '', ['class'=> 'hero-shape','alt'=>$hero_title]); ?>
        </div>


        
        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $hero_background_image)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

                    // override background image 
                    if (!empty($hero_background_image)) { 
                        echo 'background-image: url(' . $hero_background_image . ');'; } 

                    if (!empty($background_color)) {
                        echo 'background-color: ' . $background_color . ';'; }

                    if (!empty($text_color)) {
                        echo 'color: ' . $text_color . ';'; } ?> 
                }
            </style>
        <?php } ?>

    </div>

<?php } ?>
