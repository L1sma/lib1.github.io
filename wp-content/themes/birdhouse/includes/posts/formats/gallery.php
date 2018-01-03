<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Gallery

*/
?>


	<div class="st-format-gallery-holder"><?php

		if ( has_post_thumbnail() ) {
	
			if ( is_single() ) {

				if ( !empty( $birdhouse_Settings['post_feat_image'] ) == 'yes' ) {

					include( locate_template( '/includes/posts/featured-images/st-large-t1.php' ) );

				}		

			}

		}

		/*===============================================
		
			G A L L E R Y
			With different sizes dipends of some reasons
		
		===============================================*/

			if ( empty( $birdhouse_Settings['shortcodes'] ) || isset( $birdhouse_Settings['shortcodes'] ) && $birdhouse_Settings['shortcodes'] != 'no' ) {
	
				$birdhouse_['ids'] = esc_attr( st_get_post_meta( $post->ID, 'gallery_value', true, '' ) );

				if ( $birdhouse_['ids'] ) {

					if ( !empty( $birdhouse_['t'] ) && $birdhouse_['t'] == 't1' ) {
						echo do_shortcode( '[st-gallery ids="' . $birdhouse_['ids'] . '" size="' . $content_width . '" itemscustom="(50,1),(300,1),(480,1),(640,1),(943,1),(1199,1)"]' ); }
					elseif ( is_single() ) {
						echo do_shortcode( '[st-gallery ids="' . $birdhouse_['ids'] . '" size="' . $content_width . '" itemscustom="(50,1),(300,1),(480,2),(640,2),(943,2),(1199,2)"]' ); }
					else {
						echo do_shortcode( '[st-gallery ids="' . $birdhouse_['ids'] . '" size="' . $content_width . '"]' ); }

				}

			}

		?>
	
	</div>