<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Audio

*/
?>


	<div class="st-format-audio-holder"><?php

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

							echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, ( !$birdhouse_['sidebar_position'] || $birdhouse_['sidebar_position'] && $birdhouse_['sidebar_position'] != 'none' ? 'birdhouse-archive-image' : array( 1200, 1200 ) ), array( 'class' => 'size-original featured-image' ) ) . '</a>';

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


		/*===============================================
		
			A U D I O
			Post Format
		
		===============================================*/
	
			$birdhouse_['mp3'] = st_get_post_meta( $post->ID, 'mp3_value', true, '' ) ? ' mp3="' . esc_url( st_get_post_meta( $post->ID, 'mp3_value', true, '' ) ) . '"' : '';
			$birdhouse_['ogg'] = st_get_post_meta( $post->ID, 'ogg_value', true, '' ) ? ' ogg="' . esc_url( st_get_post_meta( $post->ID, 'ogg_value', true, '' ) ) . '"' : '';
			$birdhouse_['audio'] = st_get_post_meta( $post->ID, 'audio_value', true, '' );
	
	
			/*--- Audio -----------------------------*/
		
			if ( $birdhouse_['audio'] ) {
				echo $birdhouse_['audio']; }
	
			elseif ( $birdhouse_['mp3'] || $birdhouse_['ogg'] ) {
				echo do_shortcode('[audio' . $birdhouse_['mp3'] . $birdhouse_['ogg'] . ' preload=none]'); }


		?>
	
	</div>