<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$birdhouse_Options,
		$birdhouse_Settings;

	// Define classes
	$birdhouse_['class'] = has_post_thumbnail() ? 'post-related post-related-yes-thumb' : 'post-related post-related-no-thumb';

	// 1, 2, 3?
	if ( $birdhouse_['count'] == 1 ) { $birdhouse_['c'] = 'first'; }
	if ( $birdhouse_['count'] == 2 ) { $birdhouse_['c'] = 'second'; }
	if ( $birdhouse_['count'] == 3 ) { $birdhouse_['c'] = 'third'; }

	// First
	$birdhouse_['class'] .= is_page_template( 'template-frontpage.php' ) && $birdhouse_['count'] == 2 ? ' first' : '';

	// Post format
	$birdhouse_['format'] = ( get_post_format( $post->ID ) && $birdhouse_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard';
	$birdhouse_['format_label'] = $birdhouse_['format'] != 'standard' ? $birdhouse_Options['global']['post-formats'][$birdhouse_['format']]['label'] : 'Standard';

	// Add format class
	//$birdhouse_['class'] .= ' post-related-' . $birdhouse_['format'];


?>
<div class="<?php echo $birdhouse_['c']; ?>" data-format="<?php echo $birdhouse_['format']; ?>">
	<div class="<?php echo $birdhouse_['class']; ?>">
	
		<?php
	
				// Thumbnail
				if ( has_post_thumbnail() ) {
	
					$birdhouse_['id'] = get_post_thumbnail_id( $post->ID );
					$birdhouse_['thumb'] = wp_get_attachment_image_src( $birdhouse_['id'], ( 'birdhouse-project-medium' ) );
					$birdhouse_['thumb'] = $birdhouse_['thumb'][0];
					$birdhouse_['is_thumb'] = true;
	
				}
			
				else {
			
					$birdhouse_['is_thumb'] = false;
			
				}
	
				// Date
				if ( !empty( $birdhouse_Settings['nice_time'] ) && $birdhouse_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
					$birdhouse_['date'] = st_niceTime( $post->post_date_gmt ); }
				else {
					$birdhouse_['date'] = get_the_time( get_option('date_format'), $post->ID ); }
	
				// Post format
				$birdhouse_['format'] = esc_attr( ( get_post_format( $post->ID ) && $birdhouse_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard' );
	
			?>
	
		<div class="post-related-thumb">
			<?php
			
				$birdhouse_['thumb_id'] = get_post_thumbnail_id( $post->ID );
				$birdhouse_['birdhouse-project-thumb'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-project-thumb', true );
				$birdhouse_['birdhouse-project-thumb-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-project-thumb-2x', true ) : '';

				if ( $birdhouse_['thumb_id'] ) {

					echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';?>

						<img src="<?php echo $birdhouse_['birdhouse-project-thumb'][0] ?>" <?php echo !empty( $birdhouse_['birdhouse-project-thumb-2x'][0] ) ? 'srcset="' . $birdhouse_['birdhouse-project-thumb-2x'][0] . ' 2x"' : '' ?> alt="<?php the_title() ?>" />

					<?php echo '</a>';

				}

			?>
		</div>
	
		<div class="post-related-meta">
			<?php
	
				// Subtitle
				$birdhouse_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );
	
				// Title
				echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_attr( get_the_title() ) . ( $birdhouse_['subtitle'] ? ' <em>' . esc_attr( $birdhouse_['subtitle'] ) . '</em>' : '' ) . '</a></h3>';
	
				echo '<div class="meta">';
	
					// Date
					st_post_meta( false, false, true, false, false, false, false, false, false );
	
				echo '</div>';
	
			?>
		</div>
	
	</div>
</div>