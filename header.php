<header id="masthead" class="site__header siteHeader">
	<div id="navbar" class="siteHeader__navbar <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { echo 'has-logo'; } ?>">

		<div class="siteHeader__branding">
			<?php // gets custom logo if selected, otherwise displays site title  ?>
			<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?> 
				<span class="siteHeader__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<?php endif; ?>
		</div>

		<?php
			// Initialize $menu_offset
			$secondary_menu_present = wp_nav_menu( array( 'theme_location' => 'menu-2', 'echo' => false )) !== false;
			$secondary_menu_assigned = has_nav_menu('menu-2');
			$menu_offset = $secondary_menu_present && $secondary_menu_assigned ? '-menu-offset' : '';
		?>
        
		<nav id="site__navigation" class="siteNavigation <?php echo $menu_offset ?>" role="navigation" tabindex="0">
			<h3 class="screen-reader-text">Main Menu</h3>

			<?php // check if primary menu is empty and if menu location is assigned 
				$primary_menu_present = wp_nav_menu( array( 'theme_location' => 'menu-1', 'echo' => false )) !== false;
				$primary_menu_assigned = has_nav_menu('menu-1');

				if($primary_menu_present && $primary_menu_assigned) {
					wp_nav_menu(array(
					'theme_location'	=> 'menu-1',
					'echo'				=> true,
					'depth'				=> 2, 
					'container'		=> 'ul',
					'menu_class'	=> 'primary-menu ' . $menu_offset,  
					'menu_id'			=> 'primary-menu',
					'items_wrap'	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'walker'			=> new custom_walker_nav_menu
					)); 
				}
			?>

			<?php // check if secondary menu is empty, and if so, apply spacing offset 
        if($secondary_menu_present && $secondary_menu_assigned) {
            wp_nav_menu(array(
                'theme_location'  => 'menu-2',
                'echo'            => true,
                'depth'           => 2, 
                'container'       => 'ul',
                'menu_class'      => 'secondary-menu', 
                'menu_id'         => 'secondary-menu',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'walker'          => new custom_walker_nav_menu
            )); 
        }
			?>
		</nav>

		<button class="menuToggle" tabindex="0" aria-label="Menu" aria-controls="primary-menu"><?php esc_html_e( 'Menu', 'baseinstall' ); ?><span>toggle menu</span></button>

	</div>
</header>
