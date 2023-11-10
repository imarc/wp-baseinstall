<?php

/**
 * jump_link_block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'jumpLinkBlock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'jumpLinkBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$jump_link_full_title = get_field('jump_link_full_title');
$jump_link_short_title = get_field('jump_link_short_title');
$jump_link_title_hierarchy = get_field('jump_link_title_hierarchy');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/jump_link_block/jump_link_block-previews.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
            
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">
        <?php
        $title_hierarchy = '';
        if( $jump_link_title_hierarchy  == 'jump_link_h1' ){ $title_hierarchy = 'h1'; } 
        elseif( $jump_link_title_hierarchy  == 'jump_link_h2' ){ $title_hierarchy = 'h2'; } 
        elseif( $jump_link_title_hierarchy  == 'jump_link_h3' ){ $title_hierarchy = 'h3'; } 
        elseif( $jump_link_title_hierarchy  == 'jump_link_h4' ){ $title_hierarchy = 'h4'; } 
        elseif( $jump_link_title_hierarchy  == 'jump_link_h5' ){ $title_hierarchy = 'h5'; } 
        elseif( $jump_link_title_hierarchy  == 'jump_link_h6' ){ $title_hierarchy = 'h6'; } 
        else { $title_hierarchy = 'p'; } 

        echo '<' . $title_hierarchy . ' class="jumpLinkBlock__text">' . $jump_link_full_title . '</' . $title_hierarchy . '>'; ?>

        <?php if (!empty($jump_link_short_title)) { ?>
            <span class="jumpLinkBlock__shortText"><?php echo $jump_link_short_title; ?></span>
        <?php } ?>
    </div>

<?php } ?>
