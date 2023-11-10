<?php

/**
 * Logo Cloud Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logoCloud-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'logoCloud';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$logo_cloud_layout = get_field('logo_cloud_layout');
$logo_cloud_title = get_field('logo_cloud_title');
$logo_cloud_logos = have_rows('logo_cloud_logos');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/logo_cloud/logo_cloud-prevsiew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">


        <div class="logoCloud__container <?php if( $logo_cloud_layout == 'single_logo'){echo '-singleLogo';}?>">
            <?php if (!empty($logo_cloud_title)) { ?>
                <h3 class="logoCloud__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $logo_cloud_title; ?></h3>
            <?php } ?>

            <?php if( have_rows('logo_cloud_logos') ): ?>
                <div class="logoCloud__wrap">
                    <?php while( have_rows('logo_cloud_logos') ): the_row(); 
                        $image = get_sub_field('logo_cloud_logo');
                        $image_alt_text = get_post_meta($image , '_wp_attachment_image_alt', true); 
                        echo '<div class="logoCloud__logo">' . wp_get_attachment_image( $image, 'full', '', ['class'=> 'logoCloud__logoImg','alt'=>$image_alt_text]) . '</div>'; ?>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
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
