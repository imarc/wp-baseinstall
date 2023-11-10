<?php

/**
 * stripe_card_overlay Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'stripe_card_overlay-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'stripeCardOverlay';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults 
$stripe_card_overlay_alignment = get_field('stripe_with_card_overlay_alignment');
$stripe_card_overlay_eyebrow = get_field('stripe_with_card_overlay_eyebrow');
$eyebrow_appearance = get_field('eyebrow_appearance');
$stripe_card_overlay_title = get_field('stripe_with_card_overlay_title');
$title_size = get_field('title_size');
$stripe_card_overlay_copy = get_field('stripe_with_card_overlay_copy');
$stripe_card_overlay_image = get_field('stripe_with_card_overlay_card');
$stripe_card_overlay_button = get_field('stripe_with_card_overlay_button');
$stripe_with_card_overlay_secondary_button = get_field('stripe_with_card_overlay_secondary_button');
$rows = get_field('stripe_with_card_overlay_card');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/stripe_card_overlay/stripe_card_overlay-previsew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="stripeCardOverlay__container">
            <div class="stripeCardOverlay__cta <?php if( $stripe_card_overlay_alignment  == 'card_right' ){ echo '-cardRight'; } ?>">

                <div class="stripeCardOverlay__text">
                    <?php if (!empty($stripe_card_overlay_eyebrow)) { ?>
                        <div class="stripeCardOverlay__eyebrow <?php if( $eyebrow_appearance == 'eyebrow_button'){echo '-pseudoButton';}?>"><span class="stripeCardOverlay__eyebrowText <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $stripe_card_overlay_eyebrow; ?></span></div>
                    <?php } ?>

                    <?php if (!empty($stripe_card_overlay_title)) { ?>
                        <h4 class="stripeCardOverlay__title <?php if(!empty($text_color)){echo '-customColor';}?> <?php if( $title_size  == 'small_title' ){ echo '-smallTitle'; } ?>"><?php echo $stripe_card_overlay_title; ?></h4>
                    <?php } ?>

                    <?php if (!empty($stripe_card_overlay_copy)) { ?>
                        <p class="stripeCardOverlay__copy <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $stripe_card_overlay_copy; ?></p>
                    <?php } ?>

                    <?php if ($stripe_card_overlay_button) {
                        $cta_link_one_url = $stripe_card_overlay_button['url'];
                        $cta_link_one_title = $stripe_card_overlay_button['title'];
                        $cta_link_one_target = $stripe_card_overlay_button['target'] ? $stripe_card_overlay_button['target'] : '_self'; ?>
                        <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                     <?php } ?>

                    <?php if ($stripe_with_card_overlay_secondary_button) {
                        $cta_link_two_url = $stripe_with_card_overlay_secondary_button['url'];
                        $cta_link_two_title = $stripe_with_card_overlay_secondary_button['title'];
                        $cta_link_two_target = $stripe_with_card_overlay_secondary_button['target'] ? $stripe_with_card_overlay_secondary_button['target'] : '_self'; ?>
                        <a class="button" href="<?php echo esc_url( $cta_link_two_url ); ?>" target="<?php echo esc_attr( $cta_link_two_target ); ?>"><?php echo esc_html( $cta_link_two_title ); ?></a>
                     <?php } ?>
                </div>

                <div class="stripeCardOverlay__card">
                    <?php if( $rows ) { ?>
                        <div class="stripeCardOverlay__cardInner">
                            <?php foreach( $rows as $row ) { 
                                $multi_column_module_title = $row['card_title'];
                                $multi_column_module_text = $row['card_copy']; 
                                $multi_column_module_image = $row['card_image']; 
                                ?>
                                <div class="stripeCardOverlay__cardContent">
                                    <?php if(!empty($multi_column_module_title)){ ?>
                                        <div class="stripeCardOverlay__cardTitle <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $multi_column_module_title; ?></div>

                                    <?php } ?>

                                    <?php if(!empty($multi_column_module_text)){ ?>
                                        <div class="stripeCardOverlay__cardCopy <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $multi_column_module_text; ?></div>

                                    <?php } ?>

                                    <?php if(!empty($multi_column_module_image)){ 
                                        echo wp_get_attachment_image( $multi_column_module_image, 'full', '', ['class'=> 'stripeCardOverlay__cardImage','alt'=>'test']);
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>

        <div class="stripeCardOverlay__stripe"></div>

        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $top_bottom_padding)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

//                     // full div background color, using stripe style below for this block 
//                     if (!empty($background_color)) {
//                         echo 'background: ' . $background_color . ';'; }

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
            
                <?php // background stripe 
                    if (!empty($background_color)) {
                    echo '#' . $id . ' .stripeCardOverlay__stripe {background: ' . $background_color . ';}'; } 
                ?>
            </style>
        <?php } ?>
        
    </div>

<?php } ?>
