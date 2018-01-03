<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

	2 - PAGE

		2.1 - Breadcrumbs
		2.2 - Article
			- Title
			- Content
		2.3 - Pagination
		2.4 - Comments
		2.5 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$birdhouse_Settings;

		$birdhouse_ = array();

		// Is title disabled?
		$birdhouse_['title_disabled'] = esc_html( st_get_post_meta( $post->ID, 'disable_title_value', true, 0 ) );

		// Is breadcrumbs disabled?
		$birdhouse_['breadcrumbs_disabled'] = esc_html( st_get_post_meta( $post->ID, 'disable_breadcrumbs_value', true, 0 ) );
	
		// Get custom sidebar
		$birdhouse_['sidebar'] = esc_html( st_get_post_meta( $post->ID, 'sidebar_value', true, 'default-sidebar' ) );

		// bbPress sidebar sidebar
		if ( $birdhouse_Options['sidebars']['bbPress'] && function_exists('is_bbpress') ) {
			if ( is_bbpress() ) {
				$birdhouse_['sidebar'] = 'bbPress Sidebar';
				$birdhouse_['breadcrumbs_disabled'] = true;
			}
		}

		// buddyPress sidebar sidebar
		if ( $birdhouse_Options['sidebars']['buddyPress'] && function_exists('is_buddypress') ) {
			if ( is_buddypress() ) {
				$birdhouse_['sidebar'] = 'BuddyPress Sidebar'; }
		}

		// Get sidebar position
		$birdhouse_['sidebar_position'] = esc_html( st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'right' ) );

		// WooCommerce
		if ( function_exists('is_woocommerce') ) {
			if ( is_cart() || is_checkout()  ) {
				$birdhouse_['sidebar_position'] = 'none';
			}
		}

			// Re-define global $content_width if sidebar not exists
			if ( $birdhouse_['sidebar_position'] == 'none' ) {
				$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-large']['width'] ); }
			else {
				$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] ); }

		// Feat image
		$birdhouse_['is_thumb'] = false;
		if ( !empty( $birdhouse_Settings['post_feat_image'] ) == 'yes' && has_post_thumbnail() ) {
			$birdhouse_['is_thumb'] = true; }


/*===============================================

	P A G E
	Display a required page

===============================================*/

	get_header();

		?>

			<div id="content-holder" class="sidebar-position-<?php echo esc_html( $birdhouse_['sidebar_position'] ); ?> <?php echo !empty( $birdhouse_['is_thumb'] ) == true ? ' page-feat-img-yes' : ''; ?>">

				<div id="content-box">
		
					<div>

						<div>

							<?php
					
								if ( have_posts() ) :
		
									while ( have_posts() ) : the_post(); 


										/*--- Featured image ----------------------*/

										if ( $birdhouse_['is_thumb'] == true ) {

											include( locate_template( '/includes/posts/featured-images/st-large-t1.php' ) );

										}


										/*--- Content -----------------------------*/?>

										<div id="article">

											<article>

												<?php

													if ( $birdhouse_['title_disabled'] != 1 && !is_front_page() ) { ?>

														<div id="page-title"><?php
								
															/*-------------------------------------------
																2.1 - Breadcrumbs
															-------------------------------------------*/
													
															if ( $birdhouse_['breadcrumbs_disabled'] != 1 && !is_front_page() && function_exists( 'st_breadcrumbs' ) ) {
																st_breadcrumbs(); }

															/*-------------------------------------------
																2.2 - Article
															-------------------------------------------*/
													
															/*--- Title -----------------------------*/ ?>
													
															<h1 class="entry-title page-title"><?php
												
																// Title
																echo get_the_title();
												
																// Subtitle
																$birdhouse_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );
												
																	if ( $birdhouse_['subtitle'] ) {
																		echo ' <span class="title-sub">' . wp_kses( $birdhouse_['subtitle'], $birdhouse_Options['tags_allowed'] ) . '</span>'; } ?>
												
															</h1>

														</div><?php
								
													}


													the_content();

												?>

												<div class="clear"><!-- --></div>

											</article>

										</div><!-- #article -->


										<div class="clear"><!-- --></div><?php

							

										/*-------------------------------------------
											2.3 - Pagination
										-------------------------------------------*/

										if ( wp_link_pages( 'echo=0' ) ) {

											if ( function_exists('wp_pagenavi') ) {
												?><div id="wp-pagenavibox"><?php wp_pagenavi( array( 'type' => 'multipart' ) ); ?></div><?php } 

											else {
												echo '<div class="page-pagination">';
													wp_link_pages( array( 'before' => '<span>' . esc_html__( 'Pages', 'birdhouse' ) . ':</span> ' ) );
												echo '</div>';
											}

										}
							


										/*-------------------------------------------
											2.4 - Comments
										-------------------------------------------*/

										if ( !function_exists('st_kit') || !isset( $birdhouse_Settings['page_comments'] ) || !empty( $birdhouse_Settings['page_comments'] ) && $birdhouse_Settings['page_comments'] == 'yes' ) {
											comments_template(); }

							
												
									endwhile;
		
								else :
		
									echo '<h1>404</h1><p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'birdhouse' ) . '</p>';

								endif;
					
							?>

							<div class="clear"><!-- --></div>

						</div>

					</div>
			
				</div><!-- #content-box -->
	
				<?php

					/*-------------------------------------------
						2.5 - Sidebar
					-------------------------------------------*/

					if ( !isset( $birdhouse_['sidebar_position'] ) || !empty( $birdhouse_['sidebar_position'] ) && $birdhouse_['sidebar_position'] != 'none' ) {
						get_sidebar(); }

				?>

				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
	
		<?php

	get_footer();

?>