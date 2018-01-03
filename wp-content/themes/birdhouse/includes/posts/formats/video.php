<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post format: Video

*/
?>


	<div class="st-format-video-holder"><?php
	
		/*===============================================
		
			V I D E O
			Post Format
		
		===============================================*/

			$birdhouse_['mp4'] = st_get_post_meta( $post->ID, 'mp4_value', true, '' ) ? ' mp4="' . esc_url( st_get_post_meta( $post->ID, 'mp4_value', true, '' ) ) . '"' : '';
			$birdhouse_['ogv'] = st_get_post_meta( $post->ID, 'ogv_value', true, '' ) ? ' ogv="' . esc_url( st_get_post_meta( $post->ID, 'ogv_value', true, '' ) ) . '"' : '';
			$birdhouse_['webm'] = st_get_post_meta( $post->ID, 'webm_value', true, '' ) ? ' webm="' . esc_url( st_get_post_meta( $post->ID, 'webm_value', true, '' ) ) . '"' : '';
			$birdhouse_['video'] = st_get_post_meta( $post->ID, 'video_value', true, '' );
	
	
			/*--- Video -----------------------------*/

			if ( $birdhouse_['video'] ) {
				echo $birdhouse_['video']; }
	
			elseif ( $birdhouse_['mp4'] || $birdhouse_['ogv'] || $birdhouse_['webm'] ) {
	
				$birdhouse_['poster'] = wp_get_attachment_image_src( get_post_thumbnail_id(), 'birdhouse-large');
					$birdhouse_['poster'] = $birdhouse_['poster'] ? ' poster=' . esc_url( $birdhouse_['poster'][0] ) : '';
	
				echo do_shortcode('[video' . $birdhouse_['mp4'] . $birdhouse_['ogv'] . $birdhouse_['webm'] . ' preload=none ' . $birdhouse_['poster'] . ' width="' . $content_width . '" height="' . ( 9 / 16 * $content_width ) . '"]');

			}
	
		
		?>
	
	</div>