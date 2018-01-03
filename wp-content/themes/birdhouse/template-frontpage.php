<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	Template Name: Frontpage

	1 - RETRIEVE DATA

	2 - POSTS

		2.1 - Recent Posts
		2.2 - Sidebar Secondary
		2.3 - Sidebar Default

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$birdhouse_Options,
		$birdhouse_Settings,
		$paged;

		$birdhouse_ = array();

		// Template name
		$birdhouse_['t'] = $birdhouse_['t_temp'] = esc_html( !empty( $birdhouse_Settings['blog_template'] ) ? $birdhouse_Settings['blog_template'] : 'default' );

		// Get custom sidebar
		$birdhouse_['sidebar'] = esc_html( st_get_post_meta( $post->ID, 'sidebar_value', true, 'default-sidebar' ) );
	
		// Get sidebar position
		$birdhouse_['sidebar_position'] = esc_html( st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'right' ) );

		// Define content width
		$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] );

			if ( $birdhouse_['sidebar_position'] == 'none' ) {
				$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-large']['width'] ); }

		// Is blog?
		$birdhouse_['is_blog'] = true;

		// Paged
		if ( get_query_var('paged') ) {
			$paged = esc_html( get_query_var('paged') ); }
		
		elseif ( get_query_var('page') ) {
			$paged = esc_html( get_query_var('page') ); }

		else {
			$paged = 1; }
		
		$birdhouse_['paged'] = $paged;

		// Counter
		$birdhouse_['count'] = 0;


/*===============================================

	P O S T S
	Display posts archive

===============================================*/

	get_header();

		?>

			<div id="content-holder" class="sidebar-position-<?php echo esc_html( $birdhouse_['sidebar_position'] ); ?>">

				<div id="content-box">

					<div>
		
						<div>

							<div class="<?php echo $birdhouse_['sidebar_position'] == 'none' && $birdhouse_['t'] == 't6' ? 'v2' : 'v1'; ?>">

									<?php
		
		
										/*-------------------------------------------
											2.1 - Recent Posts
										-------------------------------------------*/
		
										$birdhouse_['qty'] = get_option( 'posts_per_page' );
		
										$birdhouse_['args_recent'] = array(
											'showposts'				=> $birdhouse_['qty'],
											'orderby'				=> 'date',
											'paged'					=> $birdhouse_['paged'],
											'post_status'			=> 'publish',
											'ignore_sticky_posts'	=> 1,
											'post__not_in'			=> !empty( $birdhouse_Settings['sticky_exclude'] ) && $birdhouse_Settings['sticky_exclude'] == 'yes' ? get_option('sticky_posts') : ''
										);
		
										$birdhouse_query = new WP_Query();
										wp_reset_postdata();
										$birdhouse_query->query( $birdhouse_['args_recent'] );
		
		
										/*--- Loop -----------------------------*/
		
										while ( $birdhouse_query->have_posts() ) : $birdhouse_query->the_post();
		
											$birdhouse_['count']++;

											$birdhouse_['t'] = $birdhouse_['count'] == 1 ? $birdhouse_['t'] = 'default' : $birdhouse_['t'] = $birdhouse_['t_temp'];

											include( locate_template( '/includes/posts/' . $birdhouse_['t'] . '.php' ) );

										endwhile;

		
										// Pagination
										if ( function_exists('wp_pagenavi') ) {
											?><div id="wp-pagenavibox"><?php wp_pagenavi( array( 'query' => $birdhouse_query ) ); ?></div><?php }
										else {
											?><div id="but-prev-next"><?php next_posts_link( esc_html__( 'Older posts', 'birdhouse' ), $birdhouse_query->max_num_pages ); previous_posts_link( esc_html__( 'Newer posts', 'birdhouse' ) ); ?></div><?php }
		
		
									?>

								<div class="clear"><!-- --></div>
	
							</div>

						</div>

						<div class="clear"><!-- --></div>

					</div>

				</div><!-- #content-box -->

				<?php

					/*-------------------------------------------
						2.3 - Sidebar Default
					-------------------------------------------*/

					if ( !empty( $birdhouse_['sidebar_position'] ) && $birdhouse_['sidebar_position'] != 'none' ) {
						get_sidebar(); }

				?>

				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
	
		<?php

	get_footer();

?>