<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - FEATURED POSTS

*/

/*===============================================

	F E A T U R E D   P O S T S
	Sticky posts

===============================================*/

	global
		$birdhouse_Settings,
		$birdhouse_Options,
		$paged;

		$birdhouse_['temp'] = !empty( $birdhouse_query ) ? $birdhouse_query : '';
		$birdhouse_query = null;

		$birdhouse_['is_featured'] = false;
		$birdhouse_['is_others'] = false;
		$birdhouse_['sticky_posts'] = array_filter( get_option('sticky_posts') );
		$birdhouse_['posts_sticky'] = '';
		$birdhouse_['object_type'] = '';
		$birdhouse_['featured_type'] = 'recent';


		// If no one sticky post
		if ( empty( $birdhouse_['sticky_posts'] ) ) {
			return; }


		// If frontpage
		if ( is_front_page() && !empty( $birdhouse_Settings['sticky_on_frontpage'] ) == 'yes' && $paged == 1 ) {
			$birdhouse_['is_featured'] = true; }


		// If archives
		if (
			is_category() && !empty( $birdhouse_Settings['sticky_on_archives'] ) == 'yes' ||
			is_tag() && !empty( $birdhouse_Settings['sticky_on_archives'] ) == 'yes' ||
			get_query_var('post_format') && !empty( $birdhouse_Settings['sticky_on_archives'] ) == 'yes'
			) {

				$birdhouse_['is_featured'] = true;
				$birdhouse_['featured_type'] = 'archived';
				$birdhouse_['object'] = get_queried_object();

				// Unique args
				$birdhouse_['args'] = array(
					'post__in'				=> $birdhouse_['sticky_posts'],
					'posts_per_page'		=> 5,
					'order'					=> 'DESC',
					'orderby'				=> 'date',
					'paged'					=> $paged,
					'post_status'			=> 'publish',
					'ignore_sticky_posts'	=> 1,
					'tax_query'				=> array(
													array(
														'taxonomy'	=> $birdhouse_['object']->taxonomy,
														'field'		=> 'term_id',
														'terms'		=> $birdhouse_['object']->term_id
													)
												)
				);

				// Featured type
				$birdhouse_['object_type'] = !empty( $birdhouse_['object'] ) ? $birdhouse_['object']->taxonomy . '_' . $birdhouse_['object']->term_id : '';

				// Get transient
				if ( !empty( $birdhouse_Settings['sticky_cache'] ) ) {
					$birdhouse_query = get_transient( 'st_sticky_posts_' . $birdhouse_['object_type'] ); }

				// WP Query
				if ( $birdhouse_query == false ) {
		
					$birdhouse_query = new WP_Query( $birdhouse_['args'] );
					wp_reset_postdata();
		
					if ( !empty( $birdhouse_Settings['sticky_cache'] ) ) {
						set_transient( 'st_sticky_posts_' . $birdhouse_['object_type'], $birdhouse_query, 60 * 60 * 12 ); }
		
				}

			}


		// Continue or not?
		if ( $birdhouse_['is_featured'] == false ) {
			return; }


		// Default args
		if ( empty( $birdhouse_['object'] ) ) {

			$birdhouse_['count'] = 0;

			// Unique args
			$birdhouse_['args'] = array(
				'post__in'				=> $birdhouse_['sticky_posts'],
				'posts_per_page'		=> 5,
				//'category_name'			=> $birdhouse_['sticky_cat'],
				'order'					=> 'DESC',
				'orderby'				=> 'date',
				//'paged'					=> 1,
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1
			);

			//$birdhouse_query[$birdhouse_['sticky_cat']] = '';

			// Get transient
			if ( !empty( $birdhouse_Settings['sticky_cache'] ) ) {
				$birdhouse_query = get_transient( 'st_sticky_posts' ); }

			// WP Query
			if ( $birdhouse_query == false ) {

				$birdhouse_query = new WP_Query( $birdhouse_['args'] );
				wp_reset_postdata();

				if ( !empty( $birdhouse_Settings['sticky_cache'] ) ) {
					set_transient( 'st_sticky_posts', $birdhouse_query, 60 * 60 * 12 ); }

			}

			$birdhouse_['count']++;

		}


		// Read More button
		$birdhouse_['readmore'] = array(
			'standard'	=> esc_html__( 'Read', 'birdhouse' ),
			'image'		=> esc_html__( 'View', 'birdhouse' ),
			'gallery'	=> esc_html__( 'Browse', 'birdhouse' ),
			'audio'		=> esc_html__( 'Listen', 'birdhouse' ),
			'video'		=> esc_html__( 'Watch', 'birdhouse' ),
			'link'		=> esc_html__( 'Get link', 'birdhouse' ),
			'quote'		=> esc_html__( 'More about', 'birdhouse' ),
			'status'	=> esc_html__( 'More about', 'birdhouse' )
		);


		// Post titles container
		$birdhouse_['titles'] = array();

		// Recent Sticky Posts
		if ( $birdhouse_['featured_type'] == 'recent' ) {

			if ( $birdhouse_query->found_posts ) {

				$birdhouse_['count'] = 0;


					while ( $birdhouse_query->have_posts() ) : $birdhouse_query->the_post();

						$birdhouse_['count']++;
						$birdhouse_['titles'][] = esc_attr( get_the_title() );

						include( locate_template( '/includes/posts/loop-sticky.php' ) ); 

					endwhile;



			}

		}


		// Archived Sticky Posts
		else {

			if ( $birdhouse_query->found_posts ) {

				$birdhouse_['count'] = 0;
				$birdhouse_['posts_sticky'] .= '<div class="posts-sticky">';

					while ( $birdhouse_query->have_posts() ) : $birdhouse_query->the_post();

						$birdhouse_['count']++;
						$birdhouse_['titles'][] = esc_attr( get_the_title() );

						include( locate_template( '/includes/posts/loop-sticky.php' ) ); 

					endwhile;

				$birdhouse_['posts_sticky'] .= '</div>'; //.posts-sticky

			}

		}


		// Out
		if ( $birdhouse_['posts_sticky'] ) {

			echo '<div id="owl-sticky-wrapper">';

				echo
					"\n" . '<div id="owl-sticky-tabs">' .
						( isset( $birdhouse_['titles'][0] ) ? '<div data-number="1" class="current non-selectable"><span>' . $birdhouse_['titles'][0] . '</span></div>' : '' ) .
						( isset( $birdhouse_['titles'][1] ) ? '<div data-number="2" class="non-selectable"><span>' . $birdhouse_['titles'][1] . '</span></div>' : '' ) .
						( isset( $birdhouse_['titles'][2] ) ? '<div data-number="3" class="non-selectable"><span>' . $birdhouse_['titles'][2] . '</span></div>' : '' ) .
						( isset( $birdhouse_['titles'][3] ) ? '<div data-number="4" class="non-selectable"><span>' . $birdhouse_['titles'][3] . '</span></div>' : '' ) .
						( isset( $birdhouse_['titles'][4] ) ? '<div data-number="5" class="non-selectable"><span>' . $birdhouse_['titles'][4] . '</span></div>' : '' ) .
					'</div>';
	
				echo
					"\n" . '<div id="owl-sticky" class="owl-carousel ' . 
					( $birdhouse_['featured_type'] == 'recent' ? 'owl-sticky-recent' : 'owl-sticky-archived' ) .
					( !empty( $birdhouse_Settings['sticky_autoplay'] ) == 'yes' ? ' autoplay-on' : '' ) . '">' .
						$birdhouse_['posts_sticky'] .
					'</div>' . "\n";

			echo '</div>';

		}


		$birdhouse_query = null;
		$birdhouse_query = $birdhouse_['temp'];
		wp_reset_postdata();


?>