<?php
/*

	This is standard template for archives.
	Post formats compatible.

*/

	// Define classes
	$birdhouse_['class'] = has_post_thumbnail() ? 'post-default-yes-thumb' : 'post-default-no-thumb';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post-template post-default ' . $birdhouse_['class'] ); ?>>


	<?php

		global
			$birdhouse_Options;

			// More tag
			$more = 0;

			// Post format
			$birdhouse_['format'] = esc_attr( ( get_post_format( $post->ID ) && $birdhouse_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] && function_exists( 'st_kit' ) ) ? get_post_format( $post->ID ) : 'standard' );

			include( locate_template( '/includes/posts/formats/' . $birdhouse_['format'] . '.php' ) ); 


			echo '<article itemtype="http://schema.org/Article" itemscope="">';

				// Subtitle
				$birdhouse_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );
	
				// Title
				if ( !empty($birdhouse_['title_disabled']) != 1 ) {
					echo '<header><h3 itemprop="name" class="post-title-default"><a itemprop="url" rel="bookmark" href="' . esc_url( get_permalink() ) . '">' . esc_attr( get_the_title() ) . ( $birdhouse_['subtitle'] ? ' <em>' . esc_attr( $birdhouse_['subtitle'] ) . '</em>' : '' ) . '</a></h3></header>'; }

				echo '<div class="meta">';

					// Date
					st_post_meta( false, true, false, false, false, false, false, false, false );

					// Category
					st_post_meta( false, false, true, false, false, false, false, false, false );

				echo '</div>';

				if ( is_page_template( 'template-frontpage.php' ) ) {

					// Excerpt
					echo '<div class="post-format-' . $birdhouse_['format'] . '-content content-data">'; the_excerpt(); echo '</div><div class="clear"><!-- --></div>';

					// Read More
					echo '<a href="' . get_the_permalink() . '" class="more-link">' . esc_html__( 'Continue Reading', 'birdhouse' ) . '</a>';

				}
				else {

					// Content
					echo '<div class="post-format-' . $birdhouse_['format'] . '-content content-data">'; the_content(); echo '</div><div class="clear"><!-- --></div>';
			
					// Pagination
					if ( wp_link_pages( 'echo=0' ) ) {
		
						echo '<div class="page-pagination">';
		
							if ( function_exists('wp_pagenavi') ) {
								?><div id="wp-pagenavibox"><?php wp_pagenavi( array( 'type' => 'multipart' ) ); ?></div><?php } 
		
							else {
								wp_link_pages( array( 'before' => '<span>' . esc_html__( 'Pages', 'birdhouse' ) . ':</span> ' ) ); }
		
						echo '</div>';
		
					}

				}

				if ( function_exists('st_schema_org_article_itemscope') ) {
					echo st_schema_org_article_itemscope( false ); }

			echo '</article>';

			// Social share
			if ( function_exists( 'st_post_share' ) ) {
				echo st_post_share( array( 'id' => $post->ID, 'class' => 'tooltip-css', 'attribute' => 'data-title' ) ); }

	?>

	<div class="clear"><!-- --></div>

</div><!-- .post-template -->