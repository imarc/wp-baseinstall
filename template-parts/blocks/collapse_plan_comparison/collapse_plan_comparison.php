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
$id = 'planComparison-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'planComparison';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
// collapse_plan_comparison
// Load values and assign defaults.
$collapsible_plan_title = get_field('collapsible_plan_title');
$collapsible_plan_button = get_field('collapsible_plan_button');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/collapse_plan_comparison/collapse_plan_comparison-preview.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="planComparison__heading">
            <?php if (!empty($collapsible_plan_title)) { ?>
                <h3 class="planComparison__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $collapsible_plan_title; ?></h3>
            <?php } ?>

            <button id="planComparisonToggle" class="planComparison__toggle">
                <span class="planComparison__toggleText">Show detailed plan comparison</span>
                <span id="planComparisonToggleIcon" class="icon-chevron-down planComparison__toggleIcon"></span>
            </button>
        </div>

        <div class="planComparison__container">
            <div id="planComparisonChart" class="planComparison__chart">

                <?php if( have_rows('collapsible_plan_details') ): ?>
                    <?php while( have_rows('collapsible_plan_details') ): the_row(); 
                        $border_color = get_sub_field('border_color');
                        $plan_name = get_sub_field('plan_name');
                        $copay_percentage = get_sub_field('copay_percentage');
                        $copay_label = get_sub_field('copay_label');
                        $plan_type = get_sub_field('plan_type');
                        ?>
                        <div class="planComparison__chartTable">

                            <div class="planComparison__chartBorder <?php 
                                if( $border_color == 'border_yellow' ) { echo '-yellow'; } 
                                else if( $border_color == 'border_red' ) { echo '-red'; } 
                                else if( $border_color == 'border_pink' ) { echo '-pink'; } 
                                else if( $border_color == 'border_blue' ) { echo '-blue'; } 
                                else if( $border_color == 'border_green' ) { echo '-green'; } 
                                else { echo '-default'; } ?>"></div>

                            <div class="planComparison__chartInner">

                                <?php if (!empty($plan_name)) { ?>
                                    <div class="planComparison__chartName"><?php echo $plan_name; ?></div>
                                <?php } ?>

                                <?php if (!empty($copay_percentage)) { ?>
                                    <div class="planComparison__chartPercent"><?php echo $copay_percentage; ?></div>
                                <?php } ?>

                                <?php if (!empty($copay_label)) { ?>
                                    <div class="planComparison__chartLabel">
                                        <span class="-dashedUnderline"><?php echo $copay_label; ?></span>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($plan_type)) { ?>
                                    <div class="planComparison__chartType">
                                        <span class="-dashedUnderline"><?php echo $plan_type; ?></span>
                                    </div>
                                <?php } ?>

                                <div class="planComparison__chartDetails">
                                    <?php if( have_rows('plan_details') ): ?>
                                        <?php while( have_rows('plan_details') ): the_row(); 
                                            $check_x_or_text = get_sub_field('plan_detail_text_or_icon');
                                            $plan_detail_name = get_sub_field('plan_detail_name');
                                            $plan_detail_description = get_sub_field('plan_detail_description');
                                            ?>
                                            <div class="planComparison__chartItem">
                                                <div class="planComparison__chartItemHeading">
                                                    <?php echo $plan_detail_name; ?>
                                                </div>
                                                <div class="planComparison__chartItemInfo <?php if( $check_x_or_text != 'plan_info_text' ) { echo '-icon'; } ?>">
                                                    <?php 
                                                    if( $check_x_or_text  == 'plan_info_x' ) { 
                                                        echo '<span class="icon-grey-x planComparison__icon"></span>';
                                                    } elseif( $check_x_or_text  == 'plan_info_check' ) {
                                                        echo '<span class="icon-green-check planComparison__icon"></span>';
                                                    } else {
                                                        echo $plan_detail_description;
                                                    } ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>

                            </div>

                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>

            <?php if ($collapsible_plan_button) {
                $cta_link_one_url = $collapsible_plan_button['url'];
                $cta_link_one_title = $collapsible_plan_button['title'];
                $cta_link_one_target = $collapsible_plan_button['target'] ? $collapsible_plan_button['target'] : '_self'; ?>
                <a class="planComparison__button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
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
