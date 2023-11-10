<?php

/**
 * Explore Products Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'partners_block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'partnersBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults
$partner_section_title = get_field('partner_section_title');
$rows = get_field('partner_cards');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/partners_block/partners_block-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="partnersBlock__container">

            <?php if (!empty($partner_section_title)) { ?>
                <h4 class="partnersBlock__title <?php if(!empty($text_color)){echo '-customColor';}?> "><?php echo $partner_section_title; ?></h4>
            <?php } ?>

            <?php if( $rows ) { ?>
                <div class="partnersBlock__inner">
                    <?php foreach( $rows as $row ) { 
                        $partner_logo = $row['partner_logo'];
                        $partner_link = $row['partner_link']; 
                        ?>
                        <div class="partnersBlock__block">
                            <div class="partnersBlock__blockBorder <?php if(!empty($partner_link)){echo '-hasLink';}?>">
                                <?php echo '<div class="partnersBlock__image">' . wp_get_attachment_image( $partner_logo, 'full' ) . '</div>';  ?>
                                <div class="partnersBlock__blockTextWrap">

                                    <?php 
                                    if( $partner_link ): 
                                        $cta_link_one_url = $partner_link['url'];
                                        $cta_link_one_title = $partner_link['title'];
                                        $cta_link_one_target = $partner_link['target'] ? $partner_link['target'] : '_self';
                                        ?>
                                        <a class="partnersBlock__blockLink" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>">
                                            <?php echo esc_html( $cta_link_one_title ); ?>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            <?php } ?>

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
