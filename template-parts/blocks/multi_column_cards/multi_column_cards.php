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
$id = 'multiColumnCards-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'multiColumnCards';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$multi_column_cards_title = get_field('multi_column_cards_title');
$multi_column_cards_title_color = get_field('multi_column_cards_title_color');

$rows = get_field('multi_column_cards_blocks');
$multi_column_cards_button = get_field('multi_column_cards_button');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');


// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/multi_column_cards/multi_column_cards-previsew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="multiColumnCards__container">

            <?php if (!empty($multi_column_cards_title)) { ?>
                <h4 class="multiColumnCards__title" <?php if (!empty($multi_column_cards_title_color)) { echo 'style="color: ' . $multi_column_cards_title_color . ';"'; } ?>><?php echo $multi_column_cards_title; ?></h4>
            <?php } ?>

            <?php if( $rows ) { ?>
                <div class="multiColumnCards__inner">
                    <?php foreach( $rows as $row ) { 
                        $multi_column_cards_image = $row['column_image'];
                        $multi_column_cards_eyebrow = $row['column_eyebrow'];
                        $multi_column_cards_title = $row['column_title'];
                        $multi_column_cards_text = $row['column_text']; 
                        $multi_column_cards_link = $row['column_link']; ?>

                        <div class="multiColumnCards__block">
                            <div class="multiColumnCards__blockBorder <?php if(!empty($multi_column_cards_link)){echo '-hasLink';}?>">

                                <?php echo '<div class="multiColumnCards__image">' . wp_get_attachment_image( $multi_column_cards_image, 'full' ) . '</div>'; ?>

                                <div class="multiColumnCards__blockTextWrap">
                                    <div class="multiColumnCards__blockEyebrow <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo $multi_column_cards_eyebrow; ?>
                                    </div>
                                    <div class="multiColumnCards__blockTitle <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo $multi_column_cards_title; ?>
                                    </div>
                                    <div class="multiColumnCards__blockText <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo $multi_column_cards_text; ?>
                                    </div>
                                </div>

                                <?php if( $multi_column_cards_link ): 
                                    $cta_link_one_url = $multi_column_cards_link['url'];
                                    $cta_link_one_title = $multi_column_cards_link['title'];
                                    $cta_link_one_target = $multi_column_cards_link['target'] ? $multi_column_cards_link['target'] : '_self'; ?>

                                    <a class="multiColumnCards__blockLink <?php if(!empty($text_color)){echo '-customColor';}?>" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            <?php } ?>

            <?php // button that appears below columns
                if ($multi_column_cards_button) {
                    $cta_link_one_url = $multi_column_cards_button['url'];
                    $cta_link_one_title = $multi_column_cards_button['title'];
                    $cta_link_one_target = $multi_column_cards_button['target'] ? $multi_column_cards_button['target'] : '_self'; ?>
                    <a class="multiColumnModule__button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
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
