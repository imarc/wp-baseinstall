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
$id = 'comparisonTripleFeatureCard-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'comparisonTripleFeatureCard';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$comparison_triple_feature_title = get_field('comparison_triple_feature_title');
$comparison_triple_feature_copy = get_field('comparison_triple_feature_copy');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/comparison_triple_feature_card/comparison_triple_feature_card-preview.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <?php if (!empty($comparison_triple_feature_title) || !empty($comparison_triple_feature_copy)) { ?>
            <div class="container">
                <div class="comparisonTripleFeatureCard__heading">
                    <?php if (!empty($comparison_triple_feature_title)) { ?>
                        <h2 class="comparisonTripleFeatureCard__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_triple_feature_title; ?></h2>
                    <?php } ?>
                    <?php if (!empty($comparison_triple_feature_copy)) { ?>
                        <div class="comparisonTripleFeatureCard__copy <?php if(!empty($text_color)){echo '-customColor';}?>">
                            <?php echo $comparison_triple_feature_copy; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <div class="container">
            <div class="comparisonTripleFeatureCard__row">
                <?php if( have_rows('comparison_triple_feature_list') ): ?>
                    <?php while( have_rows('comparison_triple_feature_list') ): the_row(); 
                        $comparison_triple_feature_list_title = get_sub_field('comparison_feature_list_title'); 
                        $sana_price_title = get_sub_field('sana_price_title'); 
                        $sana_price = get_sub_field('sana_price'); 
                        $legacy_price_title = get_sub_field('legacy_price_title'); 
                        $legacy_price = get_sub_field('legacy_price'); 
                        ?>
                        <div class="comparisonTripleFeatureCard__card">
                            <?php if (!empty($comparison_triple_feature_list_title)) { ?>
                                <h4 class="comparisonTripleFeatureCard__cardHeading <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_triple_feature_list_title; ?></h4>
                            <?php } ?>
                            <div class="comparisonTripleFeatureCard__cardList">
                                <?php if( have_rows('comparison_feature_list_items') ): ?>
                                    <?php while( have_rows('comparison_feature_list_items') ): the_row(); 
                                        $comparison_feature_list_description = get_sub_field('comparison_feature_list_description'); ?>
                                        <div class="comparisonTripleFeatureCard__cardListItem">
                                            <?php if (!empty($comparison_feature_list_description)) { ?>
                                                <span class="icon-plus"></span> <?php echo $comparison_feature_list_description; ?>
                                            <?php } ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                            <div class="comparisonTripleFeatureCard__cardFooter">
                                <div class="comparisonTripleFeatureCard__cardFooterBox -sana">
                                    <?php if (!empty($sana_price_title)) { ?>
                                        <div class="comparisonTripleFeatureCard__cardFooterTitle <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $sana_price_title; ?></div>
                                    <?php } ?>
                                    <?php if (!empty($sana_price)) { ?>
                                        <div class="comparisonTripleFeatureCard__cardFooterPrice <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $sana_price; ?></div>
                                    <?php } ?>
                                </div>
                                <div class="comparisonTripleFeatureCard__cardFooterBox -legacy">
                                    <?php if (!empty($legacy_price_title)) { ?>
                                        <div class="comparisonTripleFeatureCard__cardFooterTitle <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $legacy_price_title; ?></div>
                                    <?php } ?>

                                    <?php if (!empty($legacy_price)) { ?>
                                        <div class="comparisonTripleFeatureCard__cardFooterPrice <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $legacy_price; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
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
