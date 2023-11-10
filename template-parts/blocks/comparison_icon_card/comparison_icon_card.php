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
$id = 'comparisonIconCard-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'comparisonIconCard';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$comparison_icon_card_title = get_field('comparison_icon_card_title');
$comparison_icon_card_copy = get_field('comparison_icon_card_copy');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/comparison_icon_card/comparison_icon_card-preview.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="container">
            <div class="comparisonIconCard__heading">
                <?php if (!empty($comparison_icon_card_title)) { ?>
                    <h2 class="comparisonIconCard__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_icon_card_title; ?></h2>
                <?php } ?>
                <?php if (!empty($comparison_icon_card_copy)) { ?>
                    <div class="comparisonIconCard__copy <?php if(!empty($text_color)){echo '-customColor';}?>">
                        <?php echo $comparison_icon_card_copy; ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="container">
            <div class="comparisonIconCard__card">
                <?php if( have_rows('comparison_icon_list') ): ?>
                    <?php while( have_rows('comparison_icon_list') ): the_row(); 
                        $comparison_icon_list_title = get_sub_field('comparison_icon_list_title'); ?>
                        <div class="comparisonIconCard__cardTable">
                            <?php if (!empty($comparison_icon_list_title)) { ?>
                                <h4 class="comparisonIconCard__cardHeading <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_icon_list_title; ?></h4>
                            <?php } ?>
                            <?php if( have_rows('comparison_icon_list_items') ): ?>
                                <?php while( have_rows('comparison_icon_list_items') ): the_row(); 
                                    $comparison_icon_list_icon = get_sub_field('comparison_icon_list_icon');
                                    $comparison_icon_list_description = get_sub_field('comparison_icon_list_description'); ?>
                                    <div class="comparisonIconCard__cardItems">
                                        <?php echo '<div class="comparisonIconCard__cardItemImg">' . wp_get_attachment_image( $comparison_icon_list_icon, 'full' ) . '</div>';  ?>
                                        <?php if (!empty($comparison_icon_list_description)) { ?>
                                            <div class="comparisonIconCard__cardItemDesc"><?php echo $comparison_icon_list_description; ?></div>
                                        <?php } ?>
                                    </div>

                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
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
