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
$id = 'caseStudyBanner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'caseStudyBanner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$case_study_banner_eyebrow = get_field('case_study_banner_eyebrow');
$case_study_banner_title = get_field('case_study_banner_title');
$case_study_banner_copy = get_field('case_study_banner_copy');
$case_study_banner_logo = get_field('case_study_banner_logo');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/case_study_banner/case_study_banner-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> customBlock">

        <div class="caseStudyBanner__heading">

            <div class="caseStudyBanner__text">
                <div class="caseStudyBanner__textInner">
                    <?php if (!empty($case_study_banner_eyebrow)) { ?>

                        <div class="caseStudyBanner__eyebrow <?php if(!empty($text_color)){echo '-customColor';}?>">
                            <?php echo $case_study_banner_eyebrow; ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($case_study_banner_title)) { ?>
                        <h2 class="caseStudyBanner__title <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $case_study_banner_title; ?></h2>
                    <?php } ?>


                    <?php if( have_rows('case_study_banner_details') ): ?>
                        <?php while( have_rows('case_study_banner_details') ): the_row(); 

                            $case_study_banner_details_industry = get_sub_field('case_study_banner_details_industry'); 
                            $case_study_banner_details_company_size = get_sub_field('case_study_banner_details_company_size'); 
                            $case_study_banner_details_location = get_sub_field('case_study_banner_details_location'); ?>

                            <div class="caseStudyBanner__detailRow">
                                
                                <?php if (!empty($case_study_banner_details_industry)) { ?>
                                    <div class="caseStudyBanner__detail <?php if(!empty($text_color)){echo '-customColor';}?>"><span class="caseStudyBanner__descriptor">Industry:</span> <?php echo $case_study_banner_details_industry; ?></div>
                                <?php } ?>
                                
                                <?php if (!empty($case_study_banner_details_company_size)) { ?>
                                    <div class="caseStudyBanner__detail <?php if(!empty($text_color)){echo '-customColor';}?>"><span class="caseStudyBanner__descriptor">Company Size:</span> <?php echo $case_study_banner_details_company_size; ?></div>
                                <?php } ?>
                                
                                <?php if (!empty($case_study_banner_details_location)) { ?>
                                    <div class="caseStudyBanner__detail <?php if(!empty($text_color)){echo '-customColor';}?>"><span class="caseStudyBanner__descriptor">Location:</span> <?php echo $case_study_banner_details_location; ?></div>
                                <?php } ?>

                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="caseStudyBanner__image">
                <div class="caseStudyBanner__imageInner">
                    <?php echo wp_get_attachment_image( $case_study_banner_logo, 'full', '', ['class'=> 'caseStudyBanner__img','alt'=> 'alt']); ?>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="caseStudyBanner__card">

                <?php if( have_rows('case_study_banner_stats') ): ?>
                    <?php while( have_rows('case_study_banner_stats') ): the_row(); 

                        $case_study_banner_stats_heading = get_sub_field('case_study_banner_stats_heading'); 
                        $case_study_banner_stats_subheading = get_sub_field('case_study_banner_stats_subheading'); 
                        $case_study_banner_stats_description = get_sub_field('case_study_banner_stats_description'); ?>

                        <div class="caseStudyBanner__cardTable">
                            
                            <?php if (!empty($case_study_banner_stats_heading)) { ?>
                                <div class="caseStudyBanner__cardHeading <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $case_study_banner_stats_heading; ?></div>
                            <?php } ?>
                            
                            <?php if (!empty($case_study_banner_stats_subheading)) { ?>
                                <div class="caseStudyBanner__cardSubHeading <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $case_study_banner_stats_subheading; ?></div>
                            <?php } ?>
                            
                            <?php if (!empty($case_study_banner_stats_description)) { ?>
                                <div class="caseStudyBanner__cardDesc <?php if(!empty($text_color)){echo '-customColor';}?>"><?php echo $case_study_banner_stats_description; ?></div>
                            <?php } ?>

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
