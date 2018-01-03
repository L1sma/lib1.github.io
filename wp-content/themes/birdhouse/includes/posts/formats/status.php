<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Status

*/
?>

	<div class="st-format-status-holder <?php echo !empty( $birdhouse_['count'] ) && $birdhouse_['count'] % 2 == 0 ? ' even' : ' odd'; echo !empty( $birdhouse_['is_single_author_info'] ) == true ? ' single-author-info' : ''; ?>"><?php
	
		/*===============================================
		
			S T A T U S
			Post Format
		
		===============================================*/
	
			$birdhouse_['user_id'] = !empty( $birdhouse_['is_authors'] ) == true ? $birdhouse_['key']->ID : get_the_author_meta( 'ID' );
				if ( is_single() ) {
					$birdhouse_['user_id'] = $post->post_author;
				}
			$birdhouse_['upic'] = get_avatar( !empty( $birdhouse_['is_authors'] ) == true ? $birdhouse_['key']->user_email : get_the_author_meta( 'user_email' ), '110' );
				if ( is_single() ) {
					$birdhouse_['upic'] = get_avatar( get_the_author_meta( 'user_email', $post->post_author ), '110' );
				}
			$birdhouse_['name'] = esc_attr( get_the_author_meta( 'display_name', $birdhouse_['user_id'] ) );
			$birdhouse_['posts_url'] = esc_url( get_author_posts_url( $birdhouse_['user_id'] ) );
			$birdhouse_['site'] = esc_url( get_the_author_meta( 'user_url', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . esc_url( get_the_author_meta( 'user_url', $birdhouse_['user_id'] ) ) : false );
			$birdhouse_['facebook'] = esc_url( get_the_author_meta( 'facebook', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'facebook', $birdhouse_['user_id'] ) : false );
			$birdhouse_['google'] = esc_url( get_the_author_meta( 'googleplus', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'googleplus', $birdhouse_['user_id'] ) : false );
			$birdhouse_['twitter'] = esc_url( get_the_author_meta( 'twitter', $birdhouse_['user_id'] )? st_get_redirect_page_url() . 'https://twitter.com/' . get_the_author_meta( 'twitter', $birdhouse_['user_id'] ) : false );
			$birdhouse_['instagram'] = esc_url( get_the_author_meta( 'instagram', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'instagram', $birdhouse_['user_id'] ) : false );
			$birdhouse_['pinterest'] = esc_url( get_the_author_meta( 'pinterest', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'pinterest', $birdhouse_['user_id'] ) : false );
			$birdhouse_['linkedin'] = esc_url( get_the_author_meta( 'linkedin', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'linkedin', $birdhouse_['user_id'] ) : false );
			$birdhouse_['vk'] = esc_url( get_the_author_meta( 'vk', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'vk', $birdhouse_['user_id'] ) : false );
			$birdhouse_['youtube'] = esc_url( get_the_author_meta( 'youtube', $birdhouse_['user_id'] ) ? st_get_redirect_page_url() . get_the_author_meta( 'youtube', $birdhouse_['user_id'] ) : false );

			/*--- Status -----------------------------*/
		
			$birdhouse_['status'] = st_get_post_meta( $post->ID, 'status_value', true, '' );

			if ( !empty( $birdhouse_['is_authors'] ) == true || $birdhouse_['status'] || is_author() || !empty( $birdhouse_['is_single_author_info'] ) == true ) {
		
				echo "\n";
				
					?>

						<div class="status-header-upic">
							<a itemprop="author" href="<?php echo $birdhouse_['posts_url'] ?>"><?php echo $birdhouse_['upic'] ?></a>
						</div>

						<div class="status-header">
	
							<h6>
								<a href="<?php echo $birdhouse_['posts_url'] ?>"<?php echo !empty( $birdhouse_['is_single_author_info'] ) == true ? ' itemprop="author"' : ''; ?>>
									<?php
										echo $birdhouse_['name'];
										echo is_author() ? '&nbsp;<span>' . $wp_query->found_posts . '</span>' : '';
										echo !empty( $birdhouse_['is_authors'] ) == true ? '&nbsp;<span>' . $birdhouse_['key']->post_count . '</span>' : '';
									?>
								</a>
							</h6>
	
							<?php
	
								if ( $birdhouse_['site'] || $birdhouse_['facebook'] || $birdhouse_['google'] || $birdhouse_['twitter'] ) {
		
									echo '<div class="status-header-links">' . "\n";
		
										if ( $birdhouse_['site'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-flag" href="' . esc_url( $birdhouse_['site'] ) . '">' . esc_html__( 'Website', 'birdhouse' ) . '</a>' . "\n"; }
		
										if ( $birdhouse_['facebook'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-facebook" href="' . esc_url( $birdhouse_['facebook'] ) . '">' . esc_html__( 'Facebook', 'birdhouse' ) . '</a>' . "\n"; }
		
										if ( $birdhouse_['google'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-googleplus" href="' . esc_url( $birdhouse_['google'] ) . '">' . esc_html__( 'Google+', 'birdhouse' ) . '</a>' . "\n"; }
		
										if ( $birdhouse_['twitter'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-twitter" href="' . esc_url( $birdhouse_['twitter'] ) . '">' . esc_html__( 'Twitter', 'birdhouse' ) . '</a>' . "\n"; }

										if ( $birdhouse_['instagram'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-instagram" href="' . esc_url( $birdhouse_['instagram'] ) . '">' . esc_html__( 'Instagram', 'birdhouse' ) . '</a>' . "\n"; }

										if ( $birdhouse_['pinterest'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-pinterest" href="' . esc_url( $birdhouse_['pinterest'] ) . '">' . esc_html__( 'Pinterest', 'birdhouse' ) . '</a>' . "\n"; }

										if ( $birdhouse_['linkedin'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-linkedin" href="' . esc_url( $birdhouse_['linkedin'] ) . '">' . esc_html__( 'LinkedIn', 'birdhouse' ) . '</a>' . "\n"; }

										if ( $birdhouse_['vk'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-vk" href="' . esc_url( $birdhouse_['vk'] ) . '">' . esc_html__( 'VK', 'birdhouse' ) . '</a>' . "\n"; }

										if ( $birdhouse_['youtube'] ) {
											echo '<a rel="nofollow" class="ico16 ico16-youtube" href="' . esc_url( $birdhouse_['youtube'] ) . '">' . esc_html__( 'YouTube', 'birdhouse' ) . '</a>' . "\n"; }

									echo '</div>';
									
								}

							?>

							<div class="status-content cutted-closed">
								<div>
									<?php
			
										if ( !empty( $birdhouse_['is_authors'] ) == true || is_author() || !empty( $birdhouse_['is_single_author_info'] ) == true ) {
											echo wpautop( wptexturize( do_shortcode( get_the_author_meta( 'description', $birdhouse_['user_id'] ) ) ) ); }
		
										else {
											echo wpautop( wptexturize( do_shortcode( $birdhouse_['status'] ) ) ); }
			
									?>
									<div class="clear"><!-- --></div>
								</div>
							</div>

						</div>

					<?php
			}

	
		?>
	
		<div class="clear"><!-- --></div>
	</div>