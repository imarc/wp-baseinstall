<?php

/**
 * Lever Job Board Embed Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'jobBoard-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'jobBoard';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults 
$job_board_title = get_field('lever_job_board_title');
$job_board_embed = get_field('lever_job_board_embed');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/lever_jobs_embed/lever_jobs_embed-preview.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
            
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <div class="container">
            <?php if (!empty($job_board_title)) { ?>
                <h2 class="jobBoard__title"><?php echo $job_board_title; ?></h2>
            <?php } ?>

            <?php echo $job_board_embed; ?>
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
