
<?php
/**
 * The base template file.
 *
 * This is the theme wrapper template file
 * The entire site structure is included here: header, hero, content, and footer
 * If you don't want/need the hero sections, delete the calls to get_template_part('template-parts/hero') and delete hero.php
 *
 * @package baseinstall
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php // GTM head script
			$gtmHeaderScript = '';
			$options = get_option('baseinstall_options');

			// Check if $options is an array and the specific key exists
			if (is_array($options) && isset($options['baseinstall-gtm-header'])) {
			    $gtmHeaderScript = $options['baseinstall-gtm-header'];
			}

			if ($gtmHeaderScript) {
			    echo $gtmHeaderScript;
			}
		?>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

		<?php // Third-Party tracker body script
		    $options = get_option('baseinstall_options');
		    if (is_array($options) && isset($options['baseinstall-thirdparty-script-header'])) {
		        $thirdPartyHeaderScripts = $options['baseinstall-thirdparty-script-header'];
		        echo $thirdPartyHeaderScripts;
		    }
		?>

		<?php // Schema scripts, set in theme-options.php and updated in Appearance -> Theme Options 
		    if (is_front_page()) {
		        if (is_array($options) && isset($options['baseinstall-homepage-schema-scripts'])) {
		            $schemaHomepageScripts = $options['baseinstall-homepage-schema-scripts'];
		            echo $schemaHomepageScripts;
		        }
		    } else {
		        if (is_array($options) && isset($options['baseinstall-global-schema-scripts'])) {
		            $schemaGlobalScripts = $options['baseinstall-global-schema-scripts'];
		            echo $schemaGlobalScripts;
		        } 
		    }
		?>


    <?php 
	    /* CRITICAL CSS 
	     * Importing critical CSS file content, then loading deferred stylesheet with noscript fallback  */ ?>
			<style type="text/css"><?php echo file_get_contents(get_template_directory_uri() . '/assets/dist/css/critical.css');?></style>
			<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/dist/css/styles.css'; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
			<noscript><link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/dist/css/styles.css'; ?>"></noscript>
    <?php /* END CRITICAL CSS */ ?>
	</head>

	<body <?php body_class('site__wrap'); ?>>
		
		<?php // GTM body script
		$options = get_option('baseinstall_options');

		if (is_array($options) && isset($options['baseinstall-gtm-body'])) {
		    $gtmBodyScript = $options['baseinstall-gtm-body'];
		    echo $gtmBodyScript;
		}
		?>

		<?php // Third-Party tracker body script
		$options = get_option('baseinstall_options');

		if (is_array($options) && isset($options['baseinstall-thirdparty-script-body'])) {
		    $thirdPartyBodyScripts = $options['baseinstall-thirdparty-script-body'];
		    echo $thirdPartyBodyScripts;
		}
		?>

		<div id="page" class="site">

			<h1 class="screen-reader-text"><?php 
				if ( have_posts() ) :
					echo get_bloginfo( 'name' ) .' - '. get_the_title();
				else :
					echo get_bloginfo( 'name' ) .' - No results';
				endif; ?></h1>

			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'baseinstall' ); ?></a>

			<?php get_header( baseinstall_template_base() ); ?>

			<div id="content-wrap" class="siteContent__wrap">
				<div id="content" class="siteContent">
					<div id="primary" class="contentArea">
						<main id="main" class="siteMain">
							<?php include baseinstall_template_path(); ?>
						</main>
					</div>
				</div>
			</div>

			<?php get_footer( baseinstall_template_base() ); ?>

		</div>

	<?php wp_footer(); ?>


	</body>
</html>
