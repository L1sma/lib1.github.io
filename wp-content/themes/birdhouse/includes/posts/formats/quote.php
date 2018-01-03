<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Quote

*/
?>


	<div class="st-format-quote-holder"><?php

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
			
						// if sidebar (+)
						if ( !$birdhouse_['sidebar_position'] || $birdhouse_['sidebar_position'] && $birdhouse_['sidebar_position'] != 'none' ) {

							// t1
							if ( !empty( $birdhouse_['t'] ) && $birdhouse_['t'] == 't1' ) {

								include( locate_template( '/includes/posts/featured-images/st-archive-image-t1.php' ) );

							}

							else {
								echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, 'birdhouse-archive-image', array( 'class' => 'size-original featured-image' ) ) . '</a>'; }
		
						}
			
						// if sidebar (-)
						else {

							// t1
							if ( !empty( $birdhouse_['t'] ) && $birdhouse_['t'] == 't1' ) {

								include( locate_template( '/includes/posts/featured-images/st-large-t1.php' ) );

							}

							else {
								echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, ( !$birdhouse_['sidebar_position'] || $birdhouse_['sidebar_position'] && $birdhouse_['sidebar_position'] != 'none' ? 'birdhouse-archive-image' : array( 1200, 1200 ) ), array( 'class' => 'size-original featured-image' ) ) . '</a>'; }
		
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
		
			Q U O T E
			Post Format
		
		===============================================*/
		
			$birdhouse_['quote'] = esc_html( st_get_post_meta( $post->ID, 'quote_value', true, '' ) );
		
			if ( $birdhouse_['quote'] ) {
				echo '<div><blockquote><p>' . $birdhouse_['quote'] . '</p></blockquote></div>'; }

		?>
	
	</div>