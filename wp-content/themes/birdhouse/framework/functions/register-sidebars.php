<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - SIDEBARS

		- Default Sidebar
		- Secondary Sidebar
		- Post Sidebar
		- Ad Sidebars
		- Homepage Sidebars
		- Projects Sidebar
		- Footer Sidebars
		- bbPress Sidebar
		- Additional Sidebars

*/

	function st_register_sidebars() {


		/*===============================================
		
			R E T R I E V E   D A T A
			Get a required data
		
		===============================================*/
		
			global
				$birdhouse_Options,
				$birdhouse_Settings,
				$wp_registered_sidebars;
		
				$birdhouse_ = array();
		
		
		/*===============================================
		
			S I D E B A R S
			Register a new sidebars
		
		===============================================*/
		
			// Default Sidebar
			if ( $birdhouse_Options['sidebars']['default'] && !array_key_exists( 'default-sidebar', $wp_registered_sidebars ) ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'Default Sidebar',
						'id'				=> 'default-sidebar',
						'description'		=> esc_html__( 'Appears on posts and pages by default.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// Secondary Sidebar
			if ( $birdhouse_Options['sidebars']['secondary'] && !array_key_exists( 'secondary-sidebar', $wp_registered_sidebars ) ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'Secondary Sidebar',
						'id'				=> 'secondary-sidebar',
						'description'		=> esc_html__( 'Appears on archives and homepage.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// Post Sidebar
			if ( $birdhouse_Options['sidebars']['post-sidebar'] && !array_key_exists( 'post-sidebar', $wp_registered_sidebars ) ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'Post Sidebar',
						'id'				=> 'post-sidebar',
						'description'		=> esc_html__( 'Additional sidebar. Usually, it comes by left side of post. Appears on posts only.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
	
			// Offset Sidebar
			if ( $birdhouse_Options['sidebars']['offset'] && !array_key_exists( 'offset-sidebar', $wp_registered_sidebars ) ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'Offset Sidebar',
						'id'				=> 'offset-sidebar',
						'description'		=> esc_html__( 'Extra sidebar.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
			// Ad Sidebars
			if ( $birdhouse_Options['sidebars']['ads'] ) {
		
				$birdhouse_['count'] = 0;
		
				foreach ($birdhouse_Options['sidebars']['ads'] as $key ) {
		
					$birdhouse_['count']++;

					if ( array_key_exists( 'ad-sidebar-' . $birdhouse_['count'], $wp_registered_sidebars ) ) {
						return; }

					register_sidebars(
						1,
						array(
							'name'				=> 'Ad Sidebar ' . $birdhouse_['count'],
							'id'				=> 'ad-sidebar-' . $birdhouse_['count'],
							'description'		=> $key,
							'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
							'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
							'before_title'		=> '<h5><span>',
							'after_title'		=> '</span></h5>' . "\n"
						)
					);
		
				}
		
			}
		
		
			// Homepage Sidebars
			if ( $birdhouse_Options['sidebars']['homepage'] ) {
		
				$birdhouse_['count'] = 0;
		
				foreach ( $birdhouse_Options['sidebars']['homepage'] as $key ) {
		
					$birdhouse_['count']++;
		
					register_sidebars(
						1,
						array(
							'name'				=> 'Homepage Sidebar ' . $birdhouse_['count'],
							'id'				=> 'homepage-sidebar-' . $birdhouse_['count'],
							'description'		=> $key,
							'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
							'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
							'before_title'		=> '<h5><span>',
							'after_title'		=> '</span></h5>' . "\n"
						)
					);
		
				}
		
			}
		
		
			// Projects Sidebar
			if ( $birdhouse_Options['sidebars']['projects'] && !array_key_exists( 'projects-sidebar', $wp_registered_sidebars ) ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'Projects Sidebar',
						'id'				=> 'projects-sidebar',
						'description'		=> esc_html__( 'Appears on projects and archives of projects depends of selected template.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// Footer Sidebars
			if ( $birdhouse_Options['sidebars']['footer'] ) {
				register_sidebars(
					$birdhouse_Options['sidebars']['footer'],
					array(
						'name'				=> 'Footer Sidebar %d',
						'id'				=> 'footer-sidebar',
						'description'		=> esc_html__( 'Appears on all pages at the bottom of site.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// bbPress Sidebar
			if ( $birdhouse_Options['sidebars']['bbPress'] ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'bbPress Sidebar',
						'id'				=> 'bbpress-sidebar',
						'description'		=> esc_html__( 'Appears on bbPress forum pages.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// BuddyPress Sidebar
			if ( $birdhouse_Options['sidebars']['buddyPress'] ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'BuddyPress Sidebar',
						'id'				=> 'buddypress-sidebar',
						'description'		=> esc_html__( 'Appears on BuddyPress pages.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// WooCommerce Sidebar
			if ( $birdhouse_Options['sidebars']['woocommerce'] ) {
				register_sidebars(
					1,
					array(
						'name'				=> 'WooCommerce Sidebar',
						'id'				=> 'woocommerce-sidebar',
						'description'		=> esc_html__( 'Appears on WooCommerce pages.', 'birdhouse' ),
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					)
				);
			}
		
		
			// Additional Sidebars
			if ( !empty( $birdhouse_Settings['sidebar_qty'] ) ) {

				for ( $birdhouse_['x'] = 0; $birdhouse_['x'] <= $birdhouse_Settings['sidebar_qty'] - 1; $birdhouse_['x']++ ) {

					$birdhouse_['args'] = array(
						'name'				=> esc_attr( !empty( $birdhouse_Settings['sidebar_labels'][$birdhouse_['x']] ) ? $birdhouse_Settings['sidebar_labels'][$birdhouse_['x']] : 'Custom bar ' . $birdhouse_['x'] ),
						'id'				=> 'custom-bar-' . $birdhouse_['x'],
						'description'		=> '',
						'before_widget'		=> "\n" . '<div class="widget %2$s">' . "\n",
						'after_widget'		=> "\n" . '<div class="clear"><!-- --></div></div>' . "\n",
						'before_title'		=> '<h5><span>',
						'after_title'		=> '</span></h5>' . "\n"
					);

					register_sidebar( $birdhouse_['args'] );

				}

			}


	}
	
	add_action( 'widgets_init', 'st_register_sidebars' );

?>