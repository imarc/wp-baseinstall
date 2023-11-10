<?php

/**
 * Styled Blockquote Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'wysiwygRepeater-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wysiwygRepeater';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// // Load values and assign defaults.
$wysiwyg_repeater_title = get_field('wysiwyg_repeater_title');
$wysiwyg_repeater_title_hierarchy = get_field('wysiwyg_repeater_title_hierarchy');
$wysiwyg_repeater_title_alignment = get_field('wysiwyg_repeater_title_alignment');
$wysiwyg_repeater_layout = get_field('wysiwyg_repeater_layout');
$rows = get_field('wysiwyg_repeater_sidebar_card');
$wysiwyg_repeater_sidebar_text = get_field('wysiwyg_repeater_sidebar_text');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');



// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/wysiwyg_repeater/wysiwyg_repeater-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
            
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <div class="wysiwygRepeater__container">

        <?php if (!empty($wysiwyg_repeater_title)) { 
            // set heading level 
            $title_hierarchy_tag = '';
            if( $wysiwyg_repeater_title_hierarchy  == 'wysiwyg__p' ){ $title_hierarchy_tag = 'p'; } 
            elseif( $wysiwyg_repeater_title_hierarchy  == 'wysiwyg__h2' ){ $title_hierarchy_tag = 'h2'; } 
            elseif( $wysiwyg_repeater_title_hierarchy  == 'wysiwyg__h3' ){ $title_hierarchy_tag = 'h3'; } 
            elseif( $wysiwyg_repeater_title_hierarchy  == 'wysiwyg__h4' ){ $title_hierarchy_tag = 'h4'; } 
            elseif( $wysiwyg_repeater_title_hierarchy  == 'wysiwyg__h5' ){ $title_hierarchy_tag = 'h5'; } 
            elseif( $wysiwyg_repeater_title_hierarchy  == 'wysiwyg__h6' ){ $title_hierarchy_tag = 'h6'; } 
            else { $title_hierarchy_tag = 'h1'; } 

            // set heading color 
            $wysiwyg_title_color = '';
            if( !empty($text_color) ){ $wysiwyg_title_color = '-customColor'; } ?>

            <div class="wysiwygRepeater__heading <?php 
                if( $wysiwyg_repeater_title_alignment == 'text_center' ) { echo 'textAlign_center'; } 
                else if( $wysiwyg_repeater_title_alignment == 'text_right' ) { echo 'textAlign_right'; } 
                else {}?>">
                
                <<?php echo $title_hierarchy_tag . ' class="wysiwygRepeater__title ' . $wysiwyg_title_color . '"';?>>
                    <?php echo $wysiwyg_repeater_title; ?>
                </<?php echo $title_hierarchy_tag; ?>>
            </div>
        <?php } ?>

            <div class="wysiwygRepeater__row">

                <div class="wysiwygRepeater__textBlockMain <?php 
                    // adjust width if only one or two rows 
                    $count = 0;
                    $repeater = get_field('wysiwyg_repeater_blocks');
                    if (!empty($repeater)) { $count = count($repeater); }
                    if ($count == 1) { echo ' -oneCol'; } 
                    if ($count == 2) { echo ' -twoCol'; } 

                    // adjust layout if sidebar or fourth column is activated 
                    if ( $wysiwyg_repeater_layout == 'with_sidebar' ) { echo ' -sidePresent'; } 
                    else if( $wysiwyg_repeater_layout == 'four_column' ) { echo ' -fourCol'; } 
                    else { /* nothing */ } ?>">
                    <?php if( have_rows('wysiwyg_repeater_blocks') ): ?>
                        <?php while( have_rows('wysiwyg_repeater_blocks') ): the_row(); 
                            $wysiwyg_block = get_sub_field('wysiwyg_block'); ?>
                            <?php if (!empty($wysiwyg_block)) { ?>
                                <div class="wysiwygRepeater__textBlock">
                                    <div class="wysiwygRepeater__textBlockInner <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo $wysiwyg_block; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <?php if ( $wysiwyg_repeater_layout == 'with_sidebar' ) { ?>

                    <div class="wysiwygRepeater__textBlockSide">
                        <div class="wysiwygRepeater__textBlock">
                            <div class="wysiwygRepeater__textBlockInner <?php if(!empty($text_color)){echo '-customColor';}?>">

                                <?php if (!empty($wysiwyg_repeater_sidebar_text)) { ?>
                                    <?php echo $wysiwyg_repeater_sidebar_text; ?>
                                <?php } ?>

                                <?php if( have_rows('wysiwyg_repeater_sidebar_card') ): ?>
                                    <?php while( have_rows('wysiwyg_repeater_sidebar_card') ): the_row(); 
                                        $multi_column_cards_image = get_sub_field('wysiwyg_repeater_sidebar_card_image'); 
                                        $multi_column_cards_eyebrow = get_sub_field('wysiwyg_repeater_sidebar_card_eyebrow'); 
                                        $multi_column_cards_title = get_sub_field('wysiwyg_repeater_sidebar_card_title'); 
                                        $multi_column_cards_copy = get_sub_field('wysiwyg_repeater_sidebar_card_copy'); 
                                        $multi_column_cards_link = get_sub_field('wysiwyg_repeater_sidebar_card_link'); ?>

                                        <div class="wysiwygRepeater__block">
                                            <div class="wysiwygRepeater__blockBorder <?php if(!empty($multi_column_cards_link)){echo '-hasLink';}?>">
                                                <?php echo '<div class="wysiwygRepeater__image">' . wp_get_attachment_image( $multi_column_cards_image, 'full' ) . '</div>'; ?>

                                                <div class="wysiwygRepeater__blockTextWrap">

                                                    <?php if (!empty($multi_column_cards_eyebrow)) { ?>
                                                        <div class="wysiwygRepeater__blockEyebrow">
                                                            <?php echo $multi_column_cards_eyebrow; ?> 
                                                        </div>
                                                    <?php } ?>

                                                    <?php if (!empty($multi_column_cards_title)) { ?>
                                                        <div class="wysiwygRepeater__blockTitle">
                                                            <?php echo $multi_column_cards_title; ?>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if (!empty($multi_column_cards_copy)) { ?>
                                                        <div class="wysiwygRepeater__blockText">
                                                            <?php echo $multi_column_cards_copy; ?> 
                                                        </div>
                                                    <?php } ?>
                                                    
                                                </div>

                                                <?php if( $multi_column_cards_link ): 
                                                    $cta_link_one_url = $multi_column_cards_link['url'];
                                                    $cta_link_one_title = $multi_column_cards_link['title'];
                                                    $cta_link_one_target = $multi_column_cards_link['target'] ? $multi_column_cards_link['target'] : '_self'; ?>
                                                    <a class="wysiwygRepeater__blockLink" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php endwhile; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php } ?>

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
