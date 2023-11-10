<?php

/**
 * CTA Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'getQuote-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'getQuote';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$get_quote_eyebrow = get_field('get_quote_eyebrow');
$get_quote_title = get_field('get_quote_title');
$get_quote_text = get_field('get_quote_text');
$get_quote_form = get_field('get_quote_form');

$enable_after_hours_form = get_field('enable_after_hours_form');
$get_after_hours_quote_text = get_field('get_after_hours_quote_text');
$get_after_hours_quote_form = get_field('get_after_hours_quote_form');

$background_image = get_field('get_quote_background_image');
$foreground_image = get_field('get_quote_foreground_image');

$rows = get_field('quote_stats');
$quote_stats_text_color = get_field('quote_stats_text_color');


// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');


// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/get_quote/get_quote-previsew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <div class="getQuote__wrapper">
            <div class="getQuote__container">

                <div class="getQuote__containerInner <?php if(!empty($foreground_image)){echo '-foregroundImg';}?>">

                    <div class="getQuote__text">
                        <?php if (!empty($get_quote_eyebrow)) { ?>
                            <h4 class="getQuote__eyebrow <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $get_quote_eyebrow; ?></h4>
                        <?php } ?>

                        <?php if (!empty($get_quote_title)) { ?>
                            <h2 class="getQuote__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $get_quote_title; ?></h2>
                        <?php } ?>
                    </div>

                    <?php /* CONDITIONAL FORM LOGIC 

                    M-Th    7:45am - 4:45pm     Show regular form 
                    F       7:45am - 4:00pm     Show regular form 
                    S, Su   Closed              Show after hours form 

                    */

                    date_default_timezone_set('America/Chicago'); // set it to central time 

                    // This function checks the start and end time for each day of the week. 
                    function areWeOpen($day, $hour, $minutes) {
                        $hour = (int)$hour;

                        switch($day) {
                            case 'Monday':
                            if(($hour >= 7 && $minutes >= 45) || ($hour <= 16 && $minutes <= 45)) { // between 7:45am and 4:45pm 
                                return true;
                            } break;

                            case 'Tuesday':
                            if(($hour >= 7 && $minutes >= 45) || ($hour <= 16 && $minutes <= 45)) { 
                                return true;
                            } break;

                            case 'Wednesday':
                            if(($hour >= 7 && $minutes >= 45) || ($hour <= 16 && $minutes <= 45)) { 
                                return true;
                            } break;

                            case 'Thursday':
                            if(($hour >= 7 && $minutes >= 45) || ($hour <= 16 && $minutes <= 45)) { 
                                return true;
                            } break;

                            case 'Friday':
                            if(($hour >= 7 && $minutes >= 45) && $hour <= 16) { // between 7:45am and 4:00pm  
                                return true;
                            } break;

                            case 'Saturday':
                            if($hour >= 00 || ($hour <= 23 && $minutes <= 59)) { // all day 
                                return false;
                            } break;

                            case 'Sunday':
                            if($hour >= 00 || ($hour <= 23 && $minutes <= 59)) { 
                                return false;
                            } break;
                        }
                        return false;
                    }

                    $weAreOpen = areWeOpen(date('l'), date('G'), date('i'));



                    if($weAreOpen || $enable_after_hours_form != 'after_hours_enabled') { 
                        //  during normal business hours 
                        if (!empty($get_quote_text)) { ?>
                            <div class="getQuote__copy <?php if(!empty($text_color)){echo '-customColor';}?>">
                                <?php echo $get_quote_text; ?>
                            </div><?php 
                        }
                        if( $get_quote_form ){ ?>
                            <div class="marketoForm <?php if(!empty($text_color)){echo '-customColor';}?>">
                                <?php echo $get_quote_form; ?>
                            </div><?php 
                        }

                    } else { 
                        // outside of normal business hours 
                        if (!empty($get_after_hours_quote_text)) { ?>
                            <div class="getQuote__copy <?php if(!empty($text_color)){echo '-customColor';}?>">
                                <?php echo $get_after_hours_quote_text; ?>
                            </div><?php 
                        }
                        if( $get_after_hours_quote_form ){ ?>
                            <div class="marketoForm <?php if(!empty($text_color)){echo '-customColor';}?>">
                                <?php echo $get_after_hours_quote_form; ?>
                            </div><?php 
                        }
                    }
                    ?>
                </div>

            </div>


            <?php if( $rows ) { ?>
                <div class="getQuote__stats">
                    <div class="getQuote__statsContainer">

                        <?php foreach( $rows as $row ) { 
                            $multi_column_cards_title = $row['quote_stat_title'];
                            $multi_column_cards_text = $row['quote_statistic']; ?>

                                <div class="getQuote__statsText">

                                    <div class="getQuote__statTitle <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo $multi_column_cards_title; ?>
                                    </div>
                                    
                                    <div class="getQuote__statStat <?php if(!empty($text_color)){echo '-customColor';}?>">
                                        <?php echo $multi_column_cards_text; ?>
                                    </div>

                                </div>

                        <?php } ?>

                    </div>
                </div>
            <?php } ?>




            <?php if (!empty($foreground_image)) { 
                $foreground_image_alt_text = get_post_meta($foreground_image , '_wp_attachment_image_alt', true); ?> 

                <div class="getQuote__image <?php if(!empty($foreground_image)){echo '-foregroundImg';}?>">
                    <?php echo wp_get_attachment_image( $foreground_image, 'full', '', ['class'=> 'getQuote__imageImg','alt'=>$foreground_image_alt_text]); ?>
                </div>
            <?php } ?>


        </div>



        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $top_bottom_padding)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php
//                     if (!empty($background_color)) {
//                         echo 'background: ' . $background_color . ';'; }

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

                <?php // background color, image, and label text
                    // kind of convoluted because of layout 
                    // needs min-width media query for laptop (1200px and larger) 

                    // override text color in stats section 
                    if (!empty($quote_stats_text_color)) { 
                        echo '.getQuote__statTitle, .getQuote__statStat {color: ' . $quote_stats_text_color . ' !important;}'; } 

                    // override background image 
                    if (!empty($background_image)) { 
                        echo '.getQuote { 
                            background-image: url(' . $background_image . ') !important; }
                            .getQuote__stats { 
                                background-image: url(' . $background_image . ') !important; }
                            @media (min-width: 800px){.getQuote__stats {background-image: none !important;} } '; } 

                    // override partial-width background color 
                    if (!empty($background_color)) { 
                        echo '.getQuote__wrapper {background: ' . $background_color . ';} 
                        @media (min-width: 800px){.getQuote__wrapper {background: linear-gradient(to left, transparent, transparent 50%, ' . $background_color . ' 50%, ' . $background_color . ' 100%);} } 
                        .getQuote__containerInner {background: ' . $background_color . ';}'; } 

                    // override form label text color 
                    if (!empty($text_color)) { 
                        echo '.marketoForm .mktoLabel {color: ' . $text_color . ' !important;}'; } 
                ?>
            </style>
        <?php } ?>
        
    </div>

<?php } ?>
