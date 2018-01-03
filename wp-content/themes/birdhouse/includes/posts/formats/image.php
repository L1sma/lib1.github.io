<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Image

*/
?>


	<div class="st-format-image-holder"><?php
	
		/*===============================================
		
			F E A T U R E D   I M A G E
			With different sizes dipends of some reasons
		
		===============================================*/
		
			if ( has_post_thumbnail() ) {
		
				$birdhouse_['large_image_url'] = wp_get_attachment_image_src( get_post_thumbnail_id(), 'birdhouse-large' );
	
	
				/*-------------------------------------------
					on Post page:
					- sidebar(+)
					- sidebar(-)
				-------------------------------------------*/

				if ( is_single() ) {

					if ( !empty( $birdhouse_Settings['post_feat_image'] ) == 'yes' ) {

						include( locate_template( '/includes/posts/featured-images/st-large-t1.php' ) );

					}		

				}
	
	
				/*-------------------------------------------
					on Arhive page:
					- blog page, sidebar(+)
					- blog page, sidebar(-)
					- archive
				-------------------------------------------*/
			
				else {
			
					// if blog
					if ( !empty( $birdhouse_['is_blog'] ) ) {

						// t1
						if ( !empty( $birdhouse_['t'] ) && $birdhouse_['t'] == 't1' ) {

							// With sidebar
							if ( $content_width == $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] ) {

								include( locate_template( '/includes/posts/featured-images/st-archive-image-t1.php' ) );

							}

							// Without sidebar
							if ( $content_width == $birdhouse_Options['global']['images']['birdhouse-large']['width'] ) {

								include( locate_template( '/includes/posts/featured-images/st-large-t1.php' ) );

							}

						}

						else {

							echo '<a href="' . esc_url( $birdhouse_['large_image_url'][0] ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '">' . get_the_post_thumbnail( $post->ID, ( !$birdhouse_['sidebar_position'] || $birdhouse_['sidebar_position'] && $birdhouse_['sidebar_position'] != 'none' ? 'birdhouse-archive-image' : array( 1200, 1200 ) ), '' ) . '</a>';

						}
			
					}
			
					// if archive
					else {

						// t1
						if ( !empty( $birdhouse_['t'] ) && $birdhouse_['t'] == 't1' ) {

							// With sidebar
							if ( $content_width == $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] ) {

								include( locate_template( '/includes/posts/featured-images/st-archive-image-t1.php' ) );

							}

							// Without sidebar
							if ( $content_width == $birdhouse_Options['global']['images']['birdhouse-large']['width'] ) {

								include( locate_template( '/includes/posts/featured-images/st-large-t1.php' ) );

							}

						}

						else {

							echo '<a href="' . esc_url( $birdhouse_['large_image_url'][0] ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '">' . get_the_post_thumbnail( $post->ID, 'birdhouse-archive-image', array( 'class' => 'size-original' ) ) . '</a>';

						}
		
					}
			
				}
	
	
			}

		?>
	
	</div>