<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$birdhouse_Settings,
		$paged;

	// If no one featured categories
	if ( empty( $birdhouse_Settings['feat_cats'] ) ) {
		return; }

	// If not frontpage
	if ( !is_front_page() || $paged != 1 ) {
		return; }

	$birdhouse_['feat_cats'] = preg_replace('/\s+/', '', $birdhouse_Settings['feat_cats'] );
	$birdhouse_['feat_cats'] = trim( $birdhouse_['feat_cats'], ',' );
	$birdhouse_['feat_cats'] = explode( ',', $birdhouse_['feat_cats'] );
	$birdhouse_['feat_cats_selected'] = array();
	$birdhouse_['count'] = 0;

	// Display categories
	echo '<div class="featured-categories">';

		foreach( $birdhouse_['feat_cats'] as $birdhouse_['feat_cat'] ) {
	
			// Get category data
			$birdhouse_['cat'] = get_term_by( 'slug', $birdhouse_['feat_cat'], 'category' );
	
			//Does the category exist?
			if ( $birdhouse_['cat'] ) {

				$birdhouse_['feat_cats_selected'][] = $birdhouse_['cat'];

			}

			$birdhouse_['count']++;
	
		}

		$birdhouse_['count'] = 0;

		// Select image size
		if ( count( $birdhouse_['feat_cats_selected'] ) == 1 ) {
			$birdhouse_['feat_cat_image_size'] = 'birdhouse-large';
		}
		elseif ( count( $birdhouse_['feat_cats_selected'] ) == 2 ) {
			$birdhouse_['feat_cat_image_size'] = 'birdhouse-post-image';
		}
		else {
			$birdhouse_['feat_cat_image_size'] = 'birdhouse-project-medium';
		}

		foreach( $birdhouse_['feat_cats_selected'] as $birdhouse_['cat'] ) {

			// Thumb
			$birdhouse_['att_id'] = get_option( 'st_category_image_' . $birdhouse_['cat']->term_id );
			if ( $birdhouse_['att_id'] ) {
				$birdhouse_['thumb'] = wp_get_attachment_image_src( $birdhouse_['att_id'], $birdhouse_['feat_cat_image_size'] );
				//$birdhouse_['thumb-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['att_id'], $birdhouse_['feat_cat_image_size'] . '-2x', true ) : '';
				$birdhouse_['is_thumb'] = true;
			}
			else {
				$birdhouse_['thumb'] = 'none';
				$birdhouse_['is_thumb'] = false;
			}

			// Define classes
			$birdhouse_['class'] = $birdhouse_['is_thumb'] ? 'feat-cat-yes-thumb' : 'feat-cat-no-thumb';
		
			// Odd or Even?
			$birdhouse_['class'] .= $birdhouse_['count'] % 2 == 0 ? ' even' : ' odd';

			// Display
			echo '<a class="' . $birdhouse_['class'] . '" href="' . esc_url( get_category_link( $birdhouse_['cat']->term_id ) ) . '" style="' . ( $birdhouse_['is_thumb'] ? 'background-image: url(' . $birdhouse_['thumb'][0] . ')' : '' ) . '"><span>';

				// Title and Meta
				echo $birdhouse_['cat']->name . ' / ' . $birdhouse_['cat']->count;

			echo '</span></a>';

			$birdhouse_['count']++;

		}

	echo '</div>';

	echo '<div class="clear"><!-- --></div>';

?>