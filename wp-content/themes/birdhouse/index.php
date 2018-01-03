<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - POSTS

		2.1 - Loop
		2.2 - Sidebar Secondary
		2.3 - Sidebar Default

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$birdhouse_Settings;

		$birdhouse_ = array();

		// Template name
		$birdhouse_['t'] = esc_html( !empty( $birdhouse_Settings['blog_template'] ) ? $birdhouse_Settings['blog_template'] : 'default' );

		// Define content width
		$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] );

		$birdhouse_['count'] = 0;


/*===============================================

	P O S T S
	Display posts archive

===============================================*/

	get_header();

		?>
		
			<div id="content-holder" class="sidebar-position-right">
		
				<div id="content-box">
		
					<div>

						<div>

							<?php

								/*-------------------------------------------
									2.1 - Loop
								-------------------------------------------*/

								while ( have_posts() ) : the_post();
	
									include( locate_template( '/includes/posts/default.php' ) );

								endwhile;


								// Pagination
								if ( function_exists('wp_pagenavi') ) {
									?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 
								else {
									?><div id="but-prev-next"><?php next_posts_link( esc_html__( 'Older posts', 'birdhouse' ) ); previous_posts_link( esc_html__( 'Newer posts', 'birdhouse' ) ); ?></div><?php } 

							?>

							<div class="clear"><!-- --></div>

						</div>
			
						<div class="clear"><!-- --></div>

					</div>
				
				</div><!-- #content-box -->

				<?php

					/*-------------------------------------------
						2.3 - Sidebar Default
					-------------------------------------------*/

					get_sidebar();

				?>

				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
	
		<?php

	get_footer();

?>