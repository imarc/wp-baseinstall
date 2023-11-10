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
$id = 'comparisonTotalCard-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'comparisonTotalCard';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.

$comparison_total_card_heading_style = get_field('comparison_total_card_heading_style');
$comparison_total_card_title = get_field('comparison_total_card_title');
$comparison_total_card_copy = get_field('comparison_total_card_copy');


$comparison_total_card_link = get_field('comparison_total_card_link');
$comparison_total_card_sana_title = get_field('comparison_total_card_sana_title');
$comparison_total_card_others_title = get_field('comparison_total_card_others_title');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/comparison_total_card/comparison_total_card-preview.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="container">
            <div class="comparisonTotalCard__heading <?php if( $comparison_total_card_heading_style == 'center_copy' ) { echo '-centered'; } ?>">

                <?php // this chooses between the to options for the comparison heading, centered or left aligned 

                if( $comparison_total_card_heading_style == 'center_copy' ) { // if centered, get larger title and copy 

                    if (!empty($comparison_total_card_title)) { ?>
                        <h2 class="comparisonTotalCard__title -centered <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_total_card_title; ?></h2><?php } 

                    if (!empty($comparison_total_card_copy)) { ?>
                        <div class="comparisonTotalCard__copy <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_total_card_copy; ?></div><?php } 
                } else { // otherwise, get left aligned title and link 

                    if (!empty($comparison_total_card_title)) { ?>
                        <h3 class="comparisonTotalCard__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_total_card_title; ?></h3><?php } 
                    if ($comparison_total_card_link) {
                        $cta_link_one_url = $comparison_total_card_link['url'];
                        $cta_link_one_title = $comparison_total_card_link['title'];
                        $cta_link_one_target = $comparison_total_card_link['target'] ? $comparison_total_card_link['target'] : '_self'; ?>
                        <a class="comparisonTotalCard__link" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a><?php } 

                } ?>

            </div>
        </div>

        <div class="container">
            <div class="comparisonTotalCard__chart">

                <div class="comparisonTotalCard__chartTable -sana">
                    <div class="comparisonTotalCard__copayList">
                        <?php if (!empty($comparison_total_card_sana_title)) { ?>
                            <h4 class="comparisonTotalCard__copayTitle <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_total_card_sana_title; ?></h4>
                        <?php } ?>
                        <?php if( have_rows('comparison_total_sana_copay_list') ): ?>
                            <div class="comparisonTotalCard__wrap">
                                <?php while( have_rows('comparison_total_sana_copay_list') ): the_row(); 
                                    $sana_copay_title = get_sub_field('sana_copay_title');
                                    $sana_copay_amount = get_sub_field('sana_copay_amount');?>
                                    <?php if (!empty($sana_copay_title)  || !empty($sana_copay_amount)) { ?>
                                        <div class="comparisonTotalCard__copayListItem">
                                            <span class="comparisonTotalCard__copayDescription"><?php echo $sana_copay_title; ?></span>
                                            <span class="comparisonTotalCard__copayAmount <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $sana_copay_amount; ?></span>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="comparisonTotalCard__checkList">
                        <?php if( have_rows('comparison_total_sana_checklist') ): ?>
                            <div class="comparisonTotalCard__wrap">
                                <?php while( have_rows('comparison_total_sana_checklist') ): the_row(); 
                                    $sana_checklist_title = get_sub_field('sana_checklist_title');
                                    $sana_check_or_x = get_sub_field('sana_check_or_x');?>
                                    <?php if (!empty($sana_checklist_title) && !empty($sana_check_or_x)) { ?>
                                        <div class="comparisonTotalCard__checkListItem">
                                            <?php if( $sana_check_or_x  == 'sana_x' ) { 
                                                echo '<span class="icon-grey-x comparisonTotalCard__icon"></span>';
                                            } else {
                                                echo '<span class="icon-green-check comparisonTotalCard__icon"></span>';
                                            } ?>
                                            <span class="comparisonTotalCard__checkText <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $sana_checklist_title; ?></span>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="comparisonTotalCard__chartTable -others">
                    <div class="comparisonTotalCard__copayList">
                        <?php if (!empty($comparison_total_card_others_title)) { ?>
                            <h4 class="comparisonTotalCard__copayTitle <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $comparison_total_card_others_title; ?></h4>
                        <?php } ?>

                        <?php if( have_rows('comparison_total_others_copay_list') ): ?>
                            <div class="comparisonTotalCard__wrap">
                                <?php while( have_rows('comparison_total_others_copay_list') ): the_row(); 
                                    $others_copay_title = get_sub_field('others_copay_title');
                                    $others_copay_amount = get_sub_field('others_copay_amount');?>
                                    <?php if (!empty($others_copay_title) || !empty($others_copay_amount)) { ?>
                                        <div class="comparisonTotalCard__copayListItem">
                                            <span class="comparisonTotalCard__copayDescription"><?php echo $others_copay_title; ?></span>
                                            <span class="comparisonTotalCard__copayAmount"><?php echo $others_copay_amount; ?></span>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="comparisonTotalCard__checkList">
                        <?php if( have_rows('comparison_total_others_checklist') ): ?>
                            <div class="comparisonTotalCard__wrap">
                                <?php while( have_rows('comparison_total_others_checklist') ): the_row(); 
                                    $others_checklist_title = get_sub_field('others_checklist_title');
                                    $others_check_or_x = get_sub_field('others_check_or_x');?>
                                    <?php if (!empty($others_checklist_title) && !empty($others_check_or_x)) { ?>
                                        <div class="comparisonTotalCard__checkListItem">
                                            <?php if( $others_check_or_x  == 'others_x' ) { 
                                                echo '<span class="icon-grey-x comparisonTotalCard__icon"></span>';
                                            } else {
                                                echo '<span class="icon-green-check comparisonTotalCard__icon"></span>';
                                            } ?>
                                            <span class="comparisonTotalCard__checkText"><?php echo $others_checklist_title; ?></span>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

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
