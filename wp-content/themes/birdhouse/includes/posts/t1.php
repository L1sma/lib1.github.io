<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	Post formats compatible.

*/

	global
		$birdhouse_Options,
		$birdhouse_Settings;

	// Define classes
	$birdhouse_['class'] = has_post_thumbnail() ? 'post-template post-t1 post-t1-yes-thumb' : 'post-template post-t1 post-t1-no-thumb';

	// Odd or Even?
	$birdhouse_['class'] .= $birdhouse_['count'] % 2 == 0 ? ' even' : ' odd';

	// First
	$birdhouse_['class'] .= is_page_template( 'template-frontpage.php' ) && $birdhouse_['count'] == 2 ? ' first' : '';

	// Post format
	$birdhouse_['format'] = ( get_post_format( $post->ID ) && $birdhouse_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard';
	$birdhouse_['format_label'] = $birdhouse_['format'] != 'standard' ? $birdhouse_Options['global']['post-formats'][$birdhouse_['format']]['label'] : 'Standard';

	// Add format class
	$birdhouse_['class'] .= ' post-t1-' . $birdhouse_['format'];


?>
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

			echo '<div class="post-t1-format">';

				include( locate_template( '/includes/posts/formats/' . $birdhouse_['format'] . '.php' ) ); 

			echo '</div>';

		?>

	<div class="post-t1-meta">
		<?php

			// Subtitle
			$birdhouse_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );

			// Title
			echo '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_attr( get_the_title() ) . ( $birdhouse_['subtitle'] ? ' <em>' . esc_attr( $birdhouse_['subtitle'] ) . '</em>' : '' ) . '</a></h3>';

			echo '<div class="meta">';

				// Date
				st_post_meta( false, true, false, false, false, false, false, false, false );

				// Category
				st_post_meta( false, false, true, false, false, false, false, false, false );

			echo '</div>';

			// Excerpt
			echo '<div class="post-format-' . $birdhouse_['format'] . '-content content-data">'; the_excerpt(); echo '</div><div class="clear"><!-- --></div>';

			// Read More
			echo '<a href="' . get_the_permalink() . '" class="more-link">' . esc_html__( 'Continue Reading', 'birdhouse' ) . '</a>';

		?>


	</div>

	<div class="clear"><!-- --></div>

</div><!-- .post-template -->