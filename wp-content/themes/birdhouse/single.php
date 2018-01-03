<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - RETRIEVE DATA

		- Set views
		- Get post type names
		- Get post format
		- Is title disabled?
		- Is breadcrumbs disabled?
		- Get custom sidebar
		- Get sidebar position

	2 - POST

		2.2 - Article
			- Title
			- Below title data
			- Excerpt
			- Featured image
			- Before post data
			- Content
		2.3 - Pagination
		2.4 - Prev/Next post
		2.5 - Related posts
		2.6 - Comments
		2.7 - Post meta
			- Author info
			- Post short info
		2.8 - Post sidebar
		2.9 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required post data

===============================================*/

	global	
		$birdhouse_Options,
		$birdhouse_Settings;
	
		$birdhouse_ = array();

		// Post type names
		$birdhouse_['st_post'] = esc_html( !empty( $birdhouse_Settings['ctp_post'] ) ? $birdhouse_Settings['ctp_post'] : $birdhouse_Options['ctp']['post'] );

		// Post format
		$birdhouse_['format'] = esc_html( get_post_format( $post->ID ) ? get_post_format( $post->ID ) : 'standard' );

		// Does title disabled?
		$birdhouse_['title_disabled'] = esc_html( st_get_post_meta( $post->ID, 'disable_title_value', true, 0 ) );
	
		// Does breadcrumbs disabled?
		$birdhouse_['breadcrumbs_disabled'] = esc_html( st_get_post_meta( $post->ID, 'disable_breadcrumbs_value', true, 0 ) );

		// Does the post sidebar enabled?
		$birdhouse_['is_sidebar_post'] = is_active_sidebar( 'post-sidebar' ) ? ' post-sidebar-active' : ' post-sidebar-inactive';
	
		// Get custom sidebar
		$birdhouse_['sidebar'] = esc_html( st_get_post_meta( $post->ID, 'sidebar_value', true, 'default-sidebar' ) );

		// Get sidebar position
		$birdhouse_['sidebar_position'] = esc_html( st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'empty' ) );

			// Use the global default option
			if ( $birdhouse_['sidebar_position'] == 'empty' ) {
				$birdhouse_['sidebar_position'] = esc_html( !empty( $birdhouse_Settings['sidebar_position'] ) ? $birdhouse_Settings['sidebar_position'] : $birdhouse_Options['panel']['major']['sidebar']['position']['default'] ); }

			// Re-define global $content_width depends of sidebars
			if ( $birdhouse_['sidebar_position'] == 'none' ) {
				$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-large']['width'] ); }
			else {
				if ( is_active_sidebar( 'post-sidebar' ) ) {
					$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-post-image']['width'] );
				}
				else {
					$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] );
				}
			}

		// Post sidebar sticky
		$birdhouse_['sidebar_post_sticky'] = !empty( $birdhouse_Settings['sidebar_post_sticky'] ) ? ' st-sticky' : '';

		// Counter
		$birdhouse_['count'] = 0;


/*===============================================

	P O S T
	Display a required post

===============================================*/

	get_header();

		?>

			<div id="content-holder" class="sidebar-position-<?php echo esc_html( $birdhouse_['sidebar_position'] . $birdhouse_['is_sidebar_post'] ); ?>">

				<div id="content-box">
		
					<div>
		
						<?php
	
							if ( have_posts() ) :

								while ( have_posts() ) : the_post();

									// Add class in case a featured image exists & enabled
									if ( !has_post_thumbnail() || empty( $birdhouse_Settings['post_feat_image'] ) ) {
										$birdhouse_['single-feat-img-class'] = ''; }
									else {
										$birdhouse_['single-feat-img-class'] = ' single-feat-img-yes'; }

									?>

									<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-single' . $birdhouse_['single-feat-img-class'] ) ?>><?php


										// Post format
										include( locate_template( '/includes/posts/formats/' . $birdhouse_['format'] . '.php' ) );


										/*-------------------------------------------
											2.2 - Article
										-------------------------------------------*/ ?>
										
										<div id="article" class="<?php echo is_active_sidebar( 'post-sidebar' ) ? 'sidebar-post-enabled' : '' ?>" role="main">

											<article itemscope itemType="http://schema.org/BlogPosting"><?php

								
												/*-------------------------------------------
													2.1 - Breadcrumbs
												-------------------------------------------*/
										
												if ( $birdhouse_['breadcrumbs_disabled'] != 1 && function_exists( 'st_breadcrumbs' ) ) {
													st_breadcrumbs(); }


												/*-------------------------------------------
													2.2 - Title
												-------------------------------------------*/
												if ( !empty( $birdhouse_['title_disabled'] ) != 1 && get_the_title() ) { ?>
						
													<div class="clear"><!-- --></div>

													<header>
														<h1 class="entry-title post-title"><?php
												
															echo get_the_title();
												
															$birdhouse_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );
												
															if ( $birdhouse_['subtitle'] ) {
																echo ' <em>' . wp_kses( $birdhouse_['subtitle'], $birdhouse_Options['tags_allowed'] ) . '</em>'; } ?>
												
														</h1>
													</header><?php
											
												}


												/*-------------------------------------------
													2.7 - Post meta
												-------------------------------------------*/
							
												if ( !isset( $birdhouse_Settings['post_meta'] ) || !empty( $birdhouse_Settings['post_meta'] ) && $birdhouse_Settings['post_meta'] == 'yes' ) {
							
							
													/*--- Post short info -----------------------------*/ ?>
							
													<div class="post-short-info post-short-info-primary">
							
														<?php st_post_meta( false, true, true, false, false, true ); ?>
							
													</div><?php

						
												}
							
												/*--- Below title data -----------------------------*/
											
												if ( is_single() && !empty( $birdhouse_Settings['after_title'] ) && $birdhouse_Settings['after_title'] == 'yes' ) {
													echo '<div id="title-after">' . do_shortcode( !function_exists('st_kit') || empty( $birdhouse_Settings['sanitization'] ) ? esc_attr( $birdhouse_Settings['after_title_data'] ) : $birdhouse_Settings['after_title_data'] ) . '</div>'; }


												// Excerpt
												if ( is_single() && !empty( $birdhouse_Settings['excerpt'] ) && $birdhouse_Settings['excerpt'] == 'yes' && $post->post_excerpt ) {
													echo '<div class="clear"><!-- --></div><div id="post-excerpt">' . wpautop( !function_exists('st_kit') || empty( $birdhouse_Settings['sanitization'] ) ? esc_attr( $post->post_excerpt ) : $post->post_excerpt ) . '</div><div class="clear"><!-- --></div>'; }
	
												// Before post data
												if ( !empty( $birdhouse_Settings['before_post'] ) && $birdhouse_Settings['before_post'] == 'yes' ) {
													echo '<div id="post-before">' . do_shortcode( !function_exists('st_kit') || empty( $birdhouse_Settings['sanitization'] ) ? esc_attr( $birdhouse_Settings['before_post_data'] ) : $birdhouse_Settings['before_post_data'] ) . '</div>'; }
	
												the_content();

												echo '<div class="clear"><!-- --></div>';
	
	
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

													echo '<div class="post-short-info post-short-info-secondary">';
							
														st_post_meta( true, false, false, false, true, false );
							
													echo '</div>';


												echo '<footer>';



												/*--- Author info -----------------------------*/	
								
												if ( !isset( $birdhouse_Settings['author_info'] ) || !empty( $birdhouse_Settings['author_info'] ) && $birdhouse_Settings['author_info'] == 'yes' ) {
								
													$birdhouse_['is_single_author_info'] = true;
								
													include( locate_template( '/includes/posts/formats/status.php' ) );
								
													echo '<div class="clear"><!-- --></div>';
								
												}
								
												$birdhouse_['is_single_author_info'] = false;


	
												echo '</footer>';

												if ( function_exists('st_schema_org_article_itemscope') ) {
													echo st_schema_org_article_itemscope( false ); }

												if ( function_exists('st_schema_org_review_itemscope') ) {	
													echo st_schema_org_review_itemscope( false ); } ?>

											</article>

											<?php

												/*--- Social share -----------------------------*/	
						
												if ( function_exists( 'st_post_share' ) ) {
													echo st_post_share( array( 'id' => $post->ID, 'class' => 'tooltip-css', 'attribute' => 'data-title' ) );
												}	

											?>

											<div class="clear"><!-- --></div>
										</div><!-- #article -->

										<?php


											// After post data
											if ( !empty( $birdhouse_Settings['after_post'] ) && $birdhouse_Settings['after_post'] == 'yes' ) {
												echo '<div id="post-after">' . do_shortcode( !function_exists('st_kit') || empty( $birdhouse_Settings['sanitization'] ) ? esc_attr( $birdhouse_Settings['after_post_data'] ) : $birdhouse_Settings['after_post_data'] ) . '<div class="clear"><!-- --></div></div>'; }
	
	
											/*-------------------------------------------
												2.4 - Prev/Next post
											-------------------------------------------*/
	
											if ( get_post_type() == 'post' ) {
												echo st_prev_next_post(); }


											/*-------------------------------------------
												2.5 - Related posts
											-------------------------------------------*/
										
											if ( !empty( $birdhouse_Settings['related'] ) == 'yes' && function_exists( 'st_related_posts' ) ) {
						
												$birdhouse_['query'] = st_related_posts( 3, '', 'h6', 'birdhouse-project-thumb', '', false, true );
												wp_reset_postdata();
						
												if ( $birdhouse_['query']->post_count > 0 ) {
						
													$birdhouse_['limit'] = 0;
													if ( $birdhouse_['query']->post_count > 2 ) { $birdhouse_['limit'] = 3; }
													if ( $birdhouse_['query']->post_count > 5 ) { $birdhouse_['limit'] = 6; }
						
													if ( $birdhouse_['limit'] != 0 ) {
						
														echo '<h6 class="posts-related-title">' . esc_html__( 'You Might Also Like', 'birdhouse' ) . '</h6>';

														echo '<div class="posts-related-wrapper">';
							
															while ( $birdhouse_['query']->have_posts() ) : $birdhouse_['query']->the_post();
								
																if ( $birdhouse_['count'] == $birdhouse_['limit'] ) { break; }
							
																$birdhouse_['count']++;
								
																include( locate_template( '/includes/posts/related.php' ) );
						
															endwhile;
							
														echo '</div>';
						
													}
						
												}

												wp_reset_postdata();
						
											}
										

											/*-------------------------------------------
												2.6 - Comments
											-------------------------------------------*/

											echo '<div id="comments-wrapper">';

												comments_template();
												
											echo '</div>';


										?>

									</div><!-- #post-% --><?php
		
								endwhile;

							else :
	
								echo '<h1>404</h1><p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'birdhouse' ) . '</p>';
						
							endif;
		
						?>
		
						<div class="clear"><!-- --></div>
		
					</div>

				</div><!-- #content-box -->

				<?php

					/*-------------------------------------------
						2.9 - Sidebar
					-------------------------------------------*/

					if ( !isset( $birdhouse_['sidebar_position'] ) || !empty( $birdhouse_['sidebar_position'] ) && $birdhouse_['sidebar_position'] != 'none' ) {
						get_sidebar(); }

				?>

				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
	
		<?php

	get_footer();

?>