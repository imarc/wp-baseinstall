<?php

/**
 * plan_suggestion_module Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
// $id = 'planSuggestionModule-' . $block['id']; Removed $block['id'] so the anchor will not change
$id = 'planSuggestionModule';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'planSuggestionModule';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$plan_suggestion_module_title = get_field('plan_suggestion_module_title');
$plan_suggestion_module_description = get_field('plan_suggestion_module_description');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/plan_suggestion_module/plan_suggestion_module-preview.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="planSuggestionModule__container">

            <div class="planSuggestionModule__intro">
                <?php if (!empty($plan_suggestion_module_title)) { ?>
                    <h2 class="planSuggestionModule__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $plan_suggestion_module_title; ?></h2>
                <?php } ?>

                <?php if (!empty($plan_suggestion_module_description)) { ?>
                    <p class="planSuggestionModule_description <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $plan_suggestion_module_description; ?></p>
                <?php } ?>
            </div>

            <div id="app" class="planSuggestionModule__wrap">
                <!-- this is populated in Roi.vue  -->
            </div>

            <?php // color and padding options from WP block editor
                if (!empty($background_color || $text_color || $top_bottom_padding)) { ?>
                <style type="text/css">
                    #<?php echo $id; ?> { <?php

                        if (!empty($background_color) && !( $plan_suggestion_module_layout == 'plan_suggestion_module_narrow' )) {
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
                
                    <?php // background stripe 
                        if (!empty($background_color)) {
                        echo '#' . $id . ' .planSuggestionModule__container {background: ' . $background_color . ';}'; } 
                    ?>
                </style>
            <?php } ?>

        </div>
    </div>

<?php } ?>
