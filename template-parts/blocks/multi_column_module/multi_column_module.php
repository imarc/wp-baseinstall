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
$id = 'multi_column_module-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'multiColumnModule';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults
$multi_column_module_title = get_field('multi_column_module_title');
$rows = get_field('multi_column_module_blocks');
$block_options = get_field('borders_and_shadows');
$multi_column_module_button = get_field('multi_column_module_button');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/multi_column_module/multi_column_module-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?><?php
        // add borders and/or box shadow 
        if( $block_options ):
            foreach( $block_options as $block_option ):
                echo ' -' . $block_option;
            endforeach;
        endif; ?> customBlock">

        <div class="multiColumnModule__container">

            <?php if (!empty($multi_column_module_title)) { ?>
                <h4 class="multiColumnModule__title <?php if(!empty($text_color)){echo '-customColor';}?> "><?php echo $multi_column_module_title; ?></h4>
            <?php } ?>

            <?php if( $rows ) { ?>
                <div class="multiColumnModule__inner">
                    <?php foreach( $rows as $row ) { 
                        $multi_column_module_image = $row['column_icon'];
                        $multi_column_module_title = $row['column_title'];
                        $multi_column_module_text = $row['column_text']; 
                        $multi_column_module_link = $row['column_link']; 
                        $multi_column_module_icon = $row['column_link_icon_text']; 
                        ?>
                        <div class="multiColumnModule__block">
                            <div class="multiColumnModule__blockBorder <?php if(!empty($multi_column_module_link)){echo '-hasLink';}?>">
                                <?php echo '<div class="multiColumnModule__image">' . wp_get_attachment_image( $multi_column_module_image, 'full' ) . '</div>';  ?>
                                <div class="multiColumnModule__blockTextWrap">
                                    <div class="multiColumnModule__blockTitle <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $multi_column_module_title; ?></div>
                                    <div class="multiColumnModule__blockText <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $multi_column_module_text; ?></div>
                                </div>
                            <?php 
                            if( $multi_column_module_link ): 
                                $cta_link_one_url = $multi_column_module_link['url'];
                                $cta_link_one_title = $multi_column_module_link['title'];
                                $cta_link_one_target = $multi_column_module_link['target'] ? $multi_column_module_link['target'] : '_self';
                                ?>
                                <a class="multiColumnModule__blockLink <?php if ( $multi_column_module_icon == 'button_text' ) {echo '-buttonText';}?>" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>">
                                    <?php if ( $multi_column_module_icon == 'button_text' ) {
                                        echo esc_html( $cta_link_one_title );
                                    } else {
                                        echo '<span class="icon-chevron-right"></span>';
                                    } ?>
                                </a>
                            <?php endif; ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            <?php } ?>

            <?php // button that appears below columns
                if ($multi_column_module_button) {
                    $cta_link_one_url = $multi_column_module_button['url'];
                    $cta_link_one_title = $multi_column_module_button['title'];
                    $cta_link_one_target = $multi_column_module_button['target'] ? $multi_column_module_button['target'] : '_self'; ?>
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
