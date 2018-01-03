<?php if ( !defined( 'ABSPATH' ) ) exit;

	// Post format
	$birdhouse_['format'] = esc_attr( ( get_post_format( $post->ID ) && $birdhouse_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard' );

	// Feat image
	$birdhouse_['is_thumb'] = false;
	if ( has_post_thumbnail() ) {

		$birdhouse_['id'] = get_post_thumbnail_id( $post->ID );
		$birdhouse_['birdhouse-project-medium'] = wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-project-medium', true );
		$birdhouse_['birdhouse-project-medium-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-project-medium-2x', true ) : '';
		$birdhouse_['birdhouse-post-image'] = wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-post-image', true );
		$birdhouse_['birdhouse-post-image-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-post-image-2x', true ) : '';
		$birdhouse_['birdhouse-archive-image'] = wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-archive-image', true );
		$birdhouse_['birdhouse-archive-image-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-archive-image-2x', true ) : '';
		$birdhouse_['birdhouse-large'] = wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-large', true );
		$birdhouse_['birdhouse-large-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['id'], 'birdhouse-large-2x', true ) : '';

		$birdhouse_['is_thumb'] = true;

	}

	// Subtitle
	$birdhouse_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );

	// Loop: A post with thumbnail
	if ( $birdhouse_['is_thumb'] == true ) {
		$birdhouse_['post-a-with-thumb'] = "\n" .
			'<div class="post-sticky-a post-sticky-a-yes-thumb" itemtype="http://schema.org/Article" itemscope="">' .
				'<div>' .
					'<div class="post-sticky-category">' . st_wp_get_post_terms( $post->ID, 'category', true ) . '</div>' .
					'<a class="post-sticky-link" href="' . esc_url( get_permalink( $post->ID ) ) . '">' .
						'<h3 itemprop="name">' . esc_attr( get_the_title() ) . ( $birdhouse_['subtitle'] ? ' <em>' . esc_attr( $birdhouse_['subtitle'] ) . '</em>' : '' ) . '</h3>' .
						( function_exists( 'st_wp_get_post_terms' ) ? '<span class="format-before format-' . $birdhouse_['format'] . '-before"><span>' . $birdhouse_['readmore'][$birdhouse_['format']] . '</span></span>' : '' ) .
					'</a>' .
				'</div>' .
				'<picture>' .
					'<source media="(max-width: 479px)" type="image/jpg" srcset="' . $birdhouse_['birdhouse-project-medium'][0] . ' 1x' . ( $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : '' ) . '">' .
					'<source media="(max-width: 639px)" type="image/jpg" srcset="' . $birdhouse_['birdhouse-post-image'][0] . ' 1x' . ( $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : '' ) . '">' .
					'<source media="(max-width: 959px)" type="image/jpg" srcset="' . $birdhouse_['birdhouse-archive-image'][0] . ' 1x' . ( $birdhouse_['birdhouse-archive-image-2x'] ? ', ' . $birdhouse_['birdhouse-archive-image-2x'][0] . ' 2x' : '' ) . '">' .
					'<source media="(max-width: 1299px)" type="image/jpg" srcset="' . $birdhouse_['birdhouse-large'][0] . ' 1x' . ( $birdhouse_['birdhouse-large-2x'] ? ', ' . $birdhouse_['birdhouse-large-2x'][0] . ' 2x' : '' ) . '">' .
					'<source media="(min-width: 1300px)" type="image/jpg" srcset="' . $birdhouse_['birdhouse-large'][0] . ' 1x' . ( $birdhouse_['birdhouse-large-2x'] ? ', ' . $birdhouse_['birdhouse-large-2x'][0] . ' 2x' : '' ) . '">' .
					'<img src="' . $birdhouse_['birdhouse-large'][0] . '" alt="' . esc_attr( get_the_title() ) . '" />' .
				'</picture>' .
				( function_exists('st_schema_org_article_itemscope') ? st_schema_org_article_itemscope( false ) : '' ) .
			'</div>' .
		"\n";
	}

	// Loop: A post without thumbnail
	if ( $birdhouse_['is_thumb'] == false ) {
		$birdhouse_['post-a-without-thumb'] = "\n" .
			'<div class="post-sticky-a post-sticky-a-no-thumb" itemtype="http://schema.org/Article" itemscope="">' .
				'<div>' .
					'<div class="post-sticky-category">' . st_wp_get_post_terms( $post->ID, 'category', true ) . '</div>' .
					'<a class="post-sticky-link" href="' . esc_url( get_permalink( $post->ID ) ) . '">' .
						'<h3 itemprop="name">' . esc_attr( get_the_title() ) . ( $birdhouse_['subtitle'] ? ' <em>' . esc_attr( $birdhouse_['subtitle'] ) . '</em>' : '' ) . '</h3>' .
						( function_exists( 'st_wp_get_post_terms' ) ? '<span class="format-before format-' . $birdhouse_['format'] . '-before"><span>' . $birdhouse_['readmore'][$birdhouse_['format']] . '</span></span>' : '' ) .
					'</a>' .
				'</div>' .
				( function_exists('st_schema_org_article_itemscope') ? st_schema_org_article_itemscope( false ) : '' ) .
			'</div>' .
		"\n";
	}

	// A post
	$birdhouse_['posts_sticky'] .= $birdhouse_['is_thumb'] == true ? $birdhouse_['post-a-with-thumb'] : $birdhouse_['post-a-without-thumb'];


?>