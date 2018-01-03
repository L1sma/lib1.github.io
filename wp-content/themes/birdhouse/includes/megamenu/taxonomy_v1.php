<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - INCLUDES

	2 - VARIABLES

	3 - LOOP

		- Retrieve data
		- Posts

*/

/*===============================================

	I N C L U D E S
	Required includes

===============================================*/

	/* none */


/*===============================================

	V A R I A B L E S
	Regured variables

===============================================*/

	$st_['holder_id'] = sanitize_key ( isset( $_POST['holder_id'] ) ? $_POST['holder_id'] : 'none' );
	$st_['post_type'] = sanitize_key ( isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'none' );
	$st_['taxonomy'] = sanitize_key ( isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : 'none' );
	$st_['field'] = sanitize_key ( isset( $_POST['field'] ) ? $_POST['field'] : 'none' );
	$st_['terms_string'] = strtolower( preg_replace( '/\s+/', ' ', preg_replace( '/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $_POST['terms'] ) ) );
	$st_['terms'] = isset( $_POST['terms'] ) ? explode( ' ', $st_['terms_string'] ) : array();
	$st_['version'] = (string) sanitize_key ( isset( $_POST['version'] ) ? $_POST['version'] : '1' );
	$st_['paged'] = (string) sanitize_key ( isset( $_POST['paged'] ) ? $_POST['paged'] : '1' );
	$st_['qty'] = (string) sanitize_key ( isset( $_POST['qty'] ) ? $_POST['qty'] : '3' );
	$st_['out'] = '';
	$st_['max_num_pages'] = '1';
	$st_['transient_key'] = 'st_' . substr( str_replace( ' ', '-', $st_['terms_string'] ), 0, 32 ) . '_' . $st_['paged'];
	$st_['count'] = 0;


	if ( $st_['post_type'] == 'none' ) {
		_e( 'The post type is not valid or do not exist.', 'birdhouse' ); return; }

	if ( $st_['taxonomy'] == 'none' ) {
		_e( 'The taxonomy is not valid or do not exist.', 'birdhouse' ); return; }

	if ( $st_['field'] == 'none' ) {
		_e( 'The field is not valid or do not exist.', 'birdhouse' ); return; }

	if ( empty( $st_['terms'] ) ) {
		_e( "The term is not valid or doesn't exist. Or you're using a some plugin which makes a changes within normal structure of permalinks for archives, such as removing the /category/ slug.", 'birdhouse' ); return; }


	$st_['term'] = get_term_by( $st_['field'], $st_['terms'][0], $st_['taxonomy'] );
	$st_['term_link'] = get_term_link( $st_['term']->term_id, $st_['taxonomy'] );
	$st_['term_desc'] = $st_['term']->description;


	// Arguments
	$st_['args'] = array(
		'post_type'				=> $st_['post_type'],
		'posts_per_page'		=> $st_['qty'],
		'post_status'			=> 'publish',
		'order'					=> 'DESC',
		'orderby'   			=> 'date',
		'paged'					=> $st_['paged'],
		'ignore_sticky_posts'	=> 1,
		'tax_query'				=> array(
										array(
											'taxonomy'	=> $st_['taxonomy'],
											'field'		=> $st_['field'],
											'terms'		=> $st_['terms'],
										)
									),
	);


/*===============================================

	L O O P
	WordPress loop

===============================================*/


	$st_['transient'] = get_transient( $st_['transient_key'] );
	$st_['max_num_pages'] = get_transient( $st_['transient_key'] . '_max' );

	// Transient
	if ( !empty( $st_Settings['cache-megamenu'] ) == 'yes' && $st_['transient'] ) {

		$st_['out'] = $st_['transient'];

	}

	// Query
	else {

		$st_['query'] = new WP_Query( $st_['args'] );
		wp_reset_postdata();

		global
			$st_Options,
			$st_Settings;
	
			if ( $st_['query']->have_posts() ) {

				$st_['max_num_pages'] = $st_['query']->max_num_pages;
				$st_['out'] = '<div class="v-mega">';

					while ( $st_['query']->have_posts() ) : $st_['query']->the_post();

						$st_['count']++;

						// Define classes
						$st_['class'] = has_post_thumbnail() ? 'post-t6 post-t6-yes-thumb' : 'post-t6 post-t6-no-thumb';
						$st_['class'] .= $st_['count'] % 2 == 0 ? ' even' : ' odd';
						$st_['class'] .= $st_['count'] == 1 ? ' featured' : '';
						$st_['class'] .= $st_['count'] == 3 ? ' third' : '';

						// Post format
						$st_['format'] = ( get_post_format( $st_['query']->post->ID ) && $st_Options['global']['post-formats'][get_post_format( $st_['query']->post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $st_['query']->post->ID ) : 'standard';

						// Thumb
						if ( has_post_thumbnail() ) {	
			
							$st_['id'] = get_post_thumbnail_id( $st_['query']->post->ID );
							$st_['thumb'] = wp_get_attachment_image_src( $st_['id'], 'st-project-thumb' );
							$st_['thumb'] = $st_['thumb'][0];
							$st_['is_thumb'] = true;
			
						}
					
						else {
					
							$st_['is_thumb'] = false;
					
						}

						// Subtitle
						$st_['subtitle'] = get_post_meta( $st_['query']->post->ID, 'subtitle_value', true );

						// Post compilation
						$st_['out'] .= '<div class="thumb-wrapper">' .
			
							// Thumbnail
							'<div class="' . $st_['class'] . '">' .
								'<a href="' . esc_url( get_permalink() ) . '" class="post-thumb" ' . ( $st_['is_thumb'] == true && function_exists( 'st_get_2x' ) ? st_get_2x( $st_['query']->post->ID, 'st-project-thumb', 'attr' ) . ' style="background-image: url(' . $st_['thumb'] . ')"' : '' ) . ' data-format="' . $st_['format'] . '">' .
				
									'<div>' .
				
										// Meta
										( function_exists( 'st_wp_get_post_terms' ) ? '<div class="meta"><span class="format-before format-' . $st_['format'] . '-before">' . st_wp_get_post_terms( $st_['query']->post->ID, 'category', false ) . '</span></div>' : '' ) .
					
										// Review
										( function_exists( 'wp_review_show_total' ) ? wp_review_show_total(false) : '' ) .
					
										// Details
										'<div class="post-t6-details">' .
						
											// Title and Excerpt
											'<h3 class="post-title format-after format-' . $st_['format'] . '-after">' . esc_attr( get_the_title() ) . ( $st_['subtitle'] ? ' <em>' . esc_attr( $st_['subtitle'] ) . '</em>' : '' ) . '</h3>' .
							
											'<div>' . wpautop( esc_attr( get_the_excerpt() ) ) . '</div>' .
					
										'</div>' .
				
									'</div>' .
				
								'</a>' .
				
							'</div>' .
						'</div>' . "\n";
			
					endwhile;

				$st_['out'] .= '<div class="clear"><!-- --></div></div>';


				// Set transient
				if ( !empty( $st_Settings['cache-megamenu'] ) == 'yes' ) {

					set_transient( $st_['transient_key'] . '_max', $st_['max_num_pages'], 60 * 60 );
					set_transient( $st_['transient_key'], $st_['out'], 60 * 60 );

				}


			}
			
			else {
	
				echo '<p>'; _e( "Nothing found. Set a valid CSS class. Also make sure you're trying to set a mega menu on allowed menu item.", 'birdhouse' ); echo '</p>';
				return;
	
			}

	}

	// Controls, description
	$st_['out'] .=

		'<div class="clear"><!-- --></div>
		<div class="st-mega-nav">';

			// Prev
			if ( $st_['paged'] > 1 ) {
				$st_['out'] .='<a href="' . esc_url( $st_['term_link'] ) . '" data-paged="' . ( $st_['paged'] - 1 ) . '" data-holder_id="' . $st_['holder_id'] . '"  data-post_type="' . $st_['post_type'] . '"  data-taxonomy="' . $st_['taxonomy'] . '"  data-field="' . $st_['field'] . '"  data-terms="' . $st_['terms_string'] . '"  data-version="' . $st_['version'] . '"><!-- Active --></a>'; }
			else {
				$st_['out'] .= '<span><!-- Inactive --></span>'; }

			// Next
			if ( $st_['paged'] < $st_['max_num_pages'] ) {
				$st_['out'] .= '<a href="' . esc_url( $st_['term_link'] ) . '" data-paged="' . ( $st_['paged'] + 1 ) . '" data-holder_id="' . $st_['holder_id'] . '"  data-post_type="' . $st_['post_type'] . '"  data-taxonomy="' . $st_['taxonomy'] . '"  data-field="' . $st_['field'] . '"  data-terms="' . $st_['terms_string'] . '"  data-version="' . $st_['version'] . '"><!-- Active --></a>'; }
			else {
				$st_['out'] .= '<span><!-- Inactive --></span>'; }

		$st_['out'] .= '</div>';

		if ( $st_['term_desc'] ) {

			$st_['out'] .= '<div class="st-mega-desc div-as-table">
				<div>' .
					wpautop( $st_['term_desc'] ) .
				'</div>
			</div>';
		}
	
		$st_['out'] .= '<a class="st-mega-button" href="' . esc_url( $st_['term_link'] ) . '">' . __( 'Browse all', 'birdhouse' ) . '</a><div class="clear"><!-- --></div>';

	echo $st_['out'];

?>