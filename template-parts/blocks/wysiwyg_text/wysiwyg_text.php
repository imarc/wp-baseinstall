<?php

/**
 * wysiwyg_text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'wysiwygText-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wysiwygText';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$wysiwyg_layout = get_field('wysiwyg_layout');
$wysiwyg_text_alignment = get_field('wysiwyg_text_alignment');
$wysiwyg_columns = get_field('wysiwyg_columns');
$wysiwyg_title = get_field('wysiwyg_title');
$wysiwyg_title_alignment = get_field('wysiwyg_title_alignment');
$wysiwyg_text_embed = get_field('wysiwyg_block');
$wysiwyg_button = get_field('wysiwyg_button');

$wysiwyg_text_embed_two = get_field('wysiwyg_block_two');
$wysiwyg_button_two = get_field('wysiwyg_button_two');
$wysiwyg_title_hierarchy = get_field('wysiwyg_title_hierarchy');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/wysiwyg_text/wysiwyg_text-previeww.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
            
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php if($wysiwyg_text_alignment == 'text_center'){echo '-textCenter';}?> customBlock">

        <div class="wysiwygText__container <?php if( $wysiwyg_layout == 'wysiwyg_narrow' ) { echo '-wysiwygNarrow'; } ?> <?php if( empty($background_color) ) { echo '-wysiwygNarrowPad'; } ?>">

            <?php if (!empty($wysiwyg_title)) { 
                // set heading level 
                $title_hierarchy_tag = '';
                if( $wysiwyg_title_hierarchy  == 'wysiwyg__h1' ){ $title_hierarchy_tag = 'h1'; } 
                elseif( $wysiwyg_title_hierarchy  == 'wysiwyg__h2' ){ $title_hierarchy_tag = 'h2'; } 
                elseif( $wysiwyg_title_hierarchy  == 'wysiwyg__h3' ){ $title_hierarchy_tag = 'h3'; } 
                elseif( $wysiwyg_title_hierarchy  == 'wysiwyg__h4' ){ $title_hierarchy_tag = 'h4'; } 
                elseif( $wysiwyg_title_hierarchy  == 'wysiwyg__h5' ){ $title_hierarchy_tag = 'h5'; } 
                elseif( $wysiwyg_title_hierarchy  == 'wysiwyg__h6' ){ $title_hierarchy_tag = 'h6'; } 
                else { $title_hierarchy_tag = 'p'; } 

                // set heading color 
                $wysiwyg_title_color = '';
                if( !empty($text_color) ){ $wysiwyg_title_color = '-customColor'; } ?>

                <div class="wysiwygText__heading <?php 
                    if( $wysiwyg_title_alignment == 'text_center' ) { echo 'textAlign_center'; } 
                    else if( $wysiwyg_title_alignment == 'text_right' ) { echo 'textAlign_right'; } 
                    else {}?>">

                    <<?php echo $title_hierarchy_tag . ' class="wysiwygText__title ' . $wysiwyg_title_color . '"';?>>
                        <?php echo $wysiwyg_title; ?>
                    </<?php echo $title_hierarchy_tag; ?>>
                </div>
            <?php } ?>

            <div class="wysiwygText__inner <?php if($wysiwyg_columns == 'wysiwyg_two'){echo '-twoCol';}?>">
                <?php if (!empty($wysiwyg_text_embed)) { ?>
                    <div class="wysiwygText__block">
                        <div class="wysiwygText__copy <?php if(!empty($text_color)){echo '-customColor';}?>">
                            <?php echo $wysiwyg_text_embed; ?>

                            <?php if( $wysiwyg_button ): 
                                $cta_link_one_url = $wysiwyg_button['url'];
                                $cta_link_one_title = $wysiwyg_button['title'];
                                $cta_link_one_target = $wysiwyg_button['target'] ? $wysiwyg_button['target'] : '_self';
                                ?>
                                <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($wysiwyg_text_embed_two)) { ?>
                    <div class="wysiwygText__block">
                        <div class="wysiwygText__copy <?php if(!empty($text_color)){echo '-customColor';}?>">
                            <?php echo $wysiwyg_text_embed_two; ?>

                            <?php if( $wysiwyg_button_two ): 
                                $cta_link_one_url = $wysiwyg_button_two['url'];
                                $cta_link_one_title = $wysiwyg_button_two['title'];
                                $cta_link_one_target = $wysiwyg_button_two['target'] ? $wysiwyg_button_two['target'] : '_self';
                                ?>
                                <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>

        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $top_bottom_padding)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

                    if (!empty($background_color) && !( $wysiwyg_layout == 'wysiwyg_narrow' )) {
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
                    echo '#' . $id . ' .wysiwygText__container {background: ' . $background_color . ';}'; } 
                ?>
            </style>
        <?php } ?>

    </div>

<?php } ?>
