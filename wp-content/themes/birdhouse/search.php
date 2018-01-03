<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - PAGE

		2.1 - Breadcrumbs
		2.2 - Article
			- Title
			- Content
		2.3 - Pagination
		2.4 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required data

===============================================*/

	global
		$birdhouse_Options,
		$birdhouse_Settings;

		$birdhouse_ = array();
		$birdhouse_['args'] = array();

		$birdhouse_['count'] = 0;

		// Template name
		$birdhouse_['t'] = esc_html( !empty( $birdhouse_Settings['blog_template'] ) ? $birdhouse_Settings['blog_template'] : 'default' );

		// Get sidebar position
		$birdhouse_['sidebar_position'] = 'right';

		// Re-define content width
		$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] );



/*===============================================

	P A G E
	Display a required page

===============================================*/

	get_header();

		?>

			<div id="content-holder" class="sidebar-position-<?php echo esc_html( $birdhouse_['sidebar_position'] ); ?>">

				<?php

					echo '<div id="term"><div class="term-title"><h1>' . esc_html( get_search_query() ) . ' <span class="title-sub">' . esc_html( $wp_query->found_posts ) . '</span></h1></div></div>';

				?>
		
				<div id="content-box">
		
					<div>

						<div>

							<?php

								if ( have_posts() ) :
	


									// No. of current page
									$birdhouse_['p'] = $paged > 1 ? $paged : 1;
	
									// Qty of posts per page 
									$birdhouse_['per_page'] = esc_html( get_option( 'posts_per_page' ) );
	
									// No. of first post on current page
									$birdhouse_['start'] = ( $birdhouse_['p'] - 1 ) * $birdhouse_['per_page'] + 1;



									/*-------------------------------------------
										2.1 - Breadcrumbs
									-------------------------------------------*/

									echo '<div class="' . ( $birdhouse_['sidebar_position'] == 'none' && ( $birdhouse_['t'] == 't6' || $birdhouse_['t'] == 't10' || $birdhouse_['t'] == 't11' ) ? 'v2' : 'v1' ) . '">';


										while ( have_posts() ) : the_post();
		
											$birdhouse_['count']++;
		
											include( locate_template( '/includes/posts/' . $birdhouse_['t'] . '.php' ) );

										endwhile;

		
										// Pagination
										if ( function_exists('wp_pagenavi') ) {
											?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 
										else {
											?><div id="but-prev-next"><?php next_posts_link( esc_html__( 'Older posts', 'birdhouse' ) ); previous_posts_link( esc_html__( 'Newer posts', 'birdhouse' ) ); ?></div><?php } 


									echo '</div>';



								else :



									echo '<p>' . esc_html__( 'Sorry, nothing matched your search criteria. Please try again with some different keywords.', 'birdhouse' ) . '</p>';
									


								endif;
		
							?>
			
							<div class="clear"><!-- --></div>

						</div>

					</div>
		
				</div><!-- #content-box -->

				<?php

					/*-------------------------------------------
						2.4 - Sidebar
					-------------------------------------------*/

					get_sidebar();

				?>
	
				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
	
		<?php

	get_footer();

?>