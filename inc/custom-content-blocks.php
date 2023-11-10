<?php
/**
 * Custom WP Blocks  
 *
 * @package baseinstall
 */



/**
 * CUSTOM BLOCKS CATEGORY
 * Create custom ACF block category, bring to top of block list
 */
function custom_block_categories( $categories ) {
    $custom_block = array(
		'slug'  => 'custom-blocks',
		'title' => __( 'Custom Blocks', 'custom-boilerplate' ),
    );
    $categories_sorted = array();
    $categories_sorted[0] = $custom_block;
    foreach ($categories as $category) {
        $categories_sorted[] = $category;
    }
    return $categories_sorted;
}
add_filter( 'block_categories_all', 'custom_block_categories', 10, 2);



/**
 * SIMPLIFIED ACF WYSIWYG TOOLBARS 
 * Add option for simplified WYSIWYG toolbars in ACF 
 */
function sana_simple_toolbar($toolbars) {

	$toolbars['Limited'] = array();
	$toolbars['Limited'][1] = array( 'formatselect', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'bullist', 'numlist');

	$toolbars['Simple'] = array();
	$toolbars['Simple'][1] = array('bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'bullist', 'numlist');

	$toolbars['Very Simple'] = array();
	$toolbars['Very Simple'][1] = array('bold', 'italic', 'underline');

	$toolbars['Widget'] = array();
	$toolbars['Widget'][1] = array('bold', 'italic', 'link', 'unlink');

	// return $toolbars - IMPORTANT!
	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'sana_simple_toolbar');



/**
 * CUSTOM BLOCKS REGISTRATION
 * Register each of the custom blocks, add name, description, color, icon
 */
function custom_block_init_block_types() {

    // Check function exists.
	if( function_exists('acf_register_block_type') ) {

        // register a hero block.
		acf_register_block_type(array(
			'name'              => 'hero',
			'title'             => __('Hero'),
			'description'       => __('A custom hero block with heading, image, and row of logos.'),
			'render_template'   => 'template-parts/blocks/hero/hero.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'cover-image',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'hero', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));


		// register WYSIWYG Text block.
		acf_register_block_type(array( 
			'name'              => 'wysiwyg_text',
			'title'             => __('WYSIWYG Text'),
			'description'       => __('A block for plain text.'),
			'render_template'   => 'template-parts/blocks/wysiwyg_text/wysiwyg_text.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'editor-kitchensink',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'wysiwyg_text', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));
		
		// register Logo Cloud block.
		acf_register_block_type(array( 
			'name'              => 'logo_cloud',
			'title'             => __('Logo Cloud'),
			'description'       => __('A row of non-moving logos.'),
			'render_template'   => 'template-parts/blocks/logo_cloud/logo_cloud.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'superhero-alt',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'logo_cloud', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register multi_column_module block.
		acf_register_block_type(array( 
			'name'              => 'multi_column_module',
			'title'             => __('Multi Column Module'),
			'description'       => __('A row of up to four columns of icons, text, and links.'),
			'render_template'   => 'template-parts/blocks/multi_column_module/multi_column_module.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'columns',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'multi_column_module', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));
		
		// register text_and_image block.
		acf_register_block_type(array( 
			'name'              => 'text_and_image',
			'title'             => __('Text and Image Block'),
			'description'       => __('A simple block with title, text, and image with adjustable layout.'),
			'render_template'   => 'template-parts/blocks/text_and_image/text_and_image.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'id',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'text_and_image', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));
		
		// register stripe_card_overlay block.
		acf_register_block_type(array( 
			'name'              => 'stripe_card_overlay',
			'title'             => __('Stripe with Card Overlay Block'),
			'description'       => __('A simple block with title, text, and image with adjustable layout.'),
			'render_template'   => 'template-parts/blocks/stripe_card_overlay/stripe_card_overlay.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'align-pull-left',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'stripe_card_overlay', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));
		
		// register comparison_total_card block.
		// acf_register_block_type(array( 
		// 	'name'              => 'comparison_total_card',
		// 	'title'             => __('Comparison Card Table Layout'),
		// 	'description'       => __('A two-column comparison table card.'),
		// 	'render_template'   => 'template-parts/blocks/comparison_total_card/comparison_total_card.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#436003',
		// 		'foreground' => '#fff',
		// 		'src' => 'screenoptions',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'comparison_total_card', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));

        // register a CTA Banner block.
		acf_register_block_type(array(
			'name'              => 'cta_banner',
			'title'             => __('CTA Banner'),
			'description'       => __('A custom cta banner block.'),
			'render_template'   => 'template-parts/blocks/cta_banner/cta_banner.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'megaphone',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'cta_banner', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

        // register a Dismissible CTA Banner block.
		acf_register_block_type(array(
			'name'              => 'cta_banner_dismissible',
			'title'             => __('Dismissible CTA Banner'),
			'description'       => __('A custom cta banner block.'),
			'render_template'   => 'template-parts/blocks/cta_banner_dismissible/cta_banner_dismissible.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'megaphone',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'cta_banner_dismissible', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

        // register a testimonial block.
		acf_register_block_type(array(
			'name'              => 'testimonial_carousel',
			'title'             => __('Testimonial Carousel'),
			'description'       => __('Custom testimonial block with left-right swiping quotes.'),
			'render_template'   => 'template-parts/blocks/testimonial_carousel/testimonial_carousel.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'slides',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'testimonial_carousel', 'quote' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register multi_column_cards block.
		acf_register_block_type(array( 
			'name'              => 'multi_column_cards',
			'title'             => __('Multi Column Cards Block'),
			'description'       => __('A row of up to four cards with image, title, copy, and link.'),
			'render_template'   => 'template-parts/blocks/multi_column_cards/multi_column_cards.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'schedule',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'multi_column_cards', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));
		
        // register a featured posts block.
		acf_register_block_type(array(
			'name'              => 'featured_posts',
			'title'             => __('Featured Posts'),
			'description'       => __('A featured posts block that gets the three most recent blog posts.'),
			'render_template'   => 'template-parts/blocks/featured_posts/featured_posts.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'sticky',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'featured_posts', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));
		
        // register a featured posts block.
		// acf_register_block_type(array(
		// 	'name'              => 'collapse_plan_comparison',
		// 	'title'             => __('Collapsible Plan Comparison'),
		// 	'description'       => __('A featured posts block that gets the three most recent blog posts.'),
		// 	'render_template'   => 'template-parts/blocks/collapse_plan_comparison/collapse_plan_comparison.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#436003',
		// 		'foreground' => '#fff',
		// 		'src' => 'editor-table',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'collapse_plan_comparison', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));
		
		// register comparison_icon_card block.
		// acf_register_block_type(array( 
		// 	'name'              => 'comparison_icon_card',
		// 	'title'             => __('Comparison Card with Icons'),
		// 	'description'       => __('A two-column comparison card with text and icons.'),
		// 	'render_template'   => 'template-parts/blocks/comparison_icon_card/comparison_icon_card.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#436003',
		// 		'foreground' => '#fff',
		// 		'src' => 'admin-settings',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'comparison_icon_card', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));

		// register comparison_icon_card block.
		// acf_register_block_type(array( 
		// 	'name'              => 'comparison_triple_feature_card',
		// 	'title'             => __('Triple Feature Comparison Cards'),
		// 	'description'       => __('A text-based comparison card block.'),
		// 	'render_template'   => 'template-parts/blocks/comparison_triple_feature_card/comparison_triple_feature_card.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#436003',
		// 		'foreground' => '#fff',
		// 		'src' => 'ellipsis',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'comparison_triple_feature_card', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));

		// register jump_link_block block.
		acf_register_block_type(array( 
			'name'              => 'jump_link_block',
			'title'             => __('Jump Link Block'),
			'description'       => __('This block enables in-post jump links.'),
			'render_template'   => 'template-parts/blocks/jump_link_block/jump_link_block.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'arrow-down-alt2',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'jump_link_block', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register video block.
		acf_register_block_type(array( 
			'name'              => 'video',
			'title'             => __('Video Block'),
			'description'       => __('This block displays a full-width video.'),
			'render_template'   => 'template-parts/blocks/video/video.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'format-video',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'video', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register accordion_rows block.
		acf_register_block_type(array( 
			'name'              => 'accordion_rows',
			'title'             => __('Accordion Rows'),
			'description'       => __('Multi-purpose collapsible rows, good for FAQ section or similar content.'),
			'render_template'   => 'template-parts/blocks/accordion_rows/accordion_rows.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'menu-alt3',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'accordion_rows', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register vertical_tabs block.
		acf_register_block_type(array( 
			'name'              => 'vertical_tabs',
			'title'             => __('Vertical Tabs'),
			'description'       => __('Section with content panel toggled by vertical column of buttons.'),
			'render_template'   => 'template-parts/blocks/vertical_tabs/vertical_tabs.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'editor-insertmore',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'vertical_tabs', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register partners_block block.
		acf_register_block_type(array( 
			'name'              => 'partners_block',
			'title'             => __('Partners Block'),
			'description'       => __('A grid of cards with an image and link.'),
			'render_template'   => 'template-parts/blocks/partners_block/partners_block.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'groups',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'partners_block', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register get_quote block.
		acf_register_block_type(array( 
			'name'              => 'get_quote',
			'title'             => __('Contact Block'),
			'description'       => __('This section is a self-contained contact page with content and a form embed.'),
			'render_template'   => 'template-parts/blocks/get_quote/get_quote.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'format-quote',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'get_quote', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register case_study_banner block.
		acf_register_block_type(array( 
			'name'              => 'case_study_banner',
			'title'             => __('Case Study Banner'),
			'description'       => __('This section is for the top of the testimonial and customer success story detail pages.'),
			'render_template'   => 'template-parts/blocks/case_study_banner/case_study_banner.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'analytics',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'case_study_banner', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register styled_blockquote block.
		acf_register_block_type(array( 
			'name'              => 'styled_blockquote',
			'title'             => __('Styled Blockquote'),
			'description'       => __('A simple block block quote section.'),
			'render_template'   => 'template-parts/blocks/styled_blockquote/styled_blockquote.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'format-aside',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'styled_blockquote', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register wysiwyg_repeater block.
		acf_register_block_type(array( 
			'name'              => 'wysiwyg_repeater',
			'title'             => __('WYSIWYG Repeating Blocks'),
			'description'       => __('This is a section for adding multi-column sections of text in a repeatable grid pattern. Good for sections where more control over text styles is needed.'),
			'render_template'   => 'template-parts/blocks/wysiwyg_repeater/wysiwyg_repeater.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'welcome-widgets-menus',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'wysiwyg_repeater', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));

		// register lever_jobs_embed block.
		// acf_register_block_type(array( 
		// 	'name'              => 'lever_jobs_embed',
		// 	'title'             => __('Lever Job Board Block'),
		// 	'description'       => __('Copy/paste your job board embed code to show open positions.'),
		// 	'render_template'   => 'template-parts/blocks/lever_jobs_embed/lever_jobs_embed.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#436003',
		// 		'foreground' => '#fff',
		// 		'src' => 'list-view',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'lever_jobs_embed', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));



		// register kitchen_sink_elements block.
		acf_register_block_type(array( 
			'name'              => 'kitchen_sink_elements',
			'title'             => __('Kitchen Sink Page Elements'),
			'description'       => __('Displays custom page elements, not editable.'),
			'render_template'   => 'template-parts/blocks/kitchen_sink_elements/kitchen_sink_elements.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'admin-generic',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'kitchen_sink_elements', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));



        // register a Author Banner block.
		acf_register_block_type(array(
			'name'              => 'author_banner',
			'title'             => __('Author Banner'),
			'description'       => __('A custom author banner block.'),
			'render_template'   => 'template-parts/blocks/author_banner/author_banner.php',
			'category'          => 'custom-blocks',
			'icon' => array(
				'background' => '#436003',
				'foreground' => '#fff',
				'src' => 'megaphone',
			),
			'supports' => array( 'align' =>false ),
			'keywords'          => array( 'author_banner', 'feature' ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'_is_preview' => 'true'
					)
				)
			),
		));



        // register plan suggestion module block.
		// acf_register_block_type(array(
		// 	'name'              => 'plan_suggestion_module',
		// 	'title'             => __('Plan Suggestion Module'),
		// 	'description'       => __('A custom plan suggestion module block.'),
		// 	'render_template'   => 'template-parts/blocks/plan_suggestion_module/plan_suggestion_module.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#436003',
		// 		'foreground' => '#fff',
		// 		'src' => 'chart-line',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'plan_suggestion_module', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));





		// register a new block.
		// acf_register_block_type(array( 
		// 	'name'              => 'name_of_the_block',
		// 	'title'             => __('Human Readable Block Name'),
		// 	'description'       => __('This block is used for X, Y, and Z.'),
		// 	'render_template'   => 'template-parts/blocks/name_of_the_block/name_of_the_block.php',
		// 	'category'          => 'custom-blocks',
		// 	'icon' => array(
		// 		'background' => '#FFB852',
		// 		'foreground' => '#fff',
		// 		'src' => 'editor-table',
		// 	),
		// 	'supports' => array( 'align' =>false ),
		// 	'keywords'          => array( 'name_of_the_block', 'feature' ),
		// 	'example'  => array(
		// 		'attributes' => array(
		// 			'mode' => 'preview',
		// 			'data' => array(
		// 				'_is_preview' => 'true'
		// 			)
		// 		)
		// 	),
		// ));


	}
}
add_action('acf/init', 'custom_block_init_block_types');

