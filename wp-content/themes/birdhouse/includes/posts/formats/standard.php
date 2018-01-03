<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Standard

*/
?>


	<div class="st-format-standard-holder"><?php

		/*--- Title -----------------------------*/

		if ( !is_single() && !empty($birdhouse_['t']) != 't4' && !empty($birdhouse_['title_disabled']) != 1 ) { ?>
			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php }
	
		
		/*===============================================
		
			F E A T U R E D   I M A G E
			With different sizes dipends of many reasons
		
		===============================================*/

			if ( has_post_thumbnail() ) {

				/*-------------------------------------------
					on Post page:
					- sidebar(+), modal window(+)
					- sidebar(+), modal window(-)
					- sidebar(-), modal window(+)
					- sidebar(-), modal window(-)
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

							echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, 'birdhouse-large', array( 'class' => 'size-original featured-image' ) ) . '</a>';

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

							echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, 'birdhouse-archive-image', array( 'class' => 'size-original featured-image' ) ) . '</a>';

						}

					}
		
				}
		
			}

		?>
	
	</div>