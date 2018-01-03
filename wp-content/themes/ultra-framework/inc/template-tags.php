<?php
/*
 * Custom template tags for this theme.
 */

if ( ! function_exists( 'ultra_framework_posted_on' ) ) :
/*
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ultra_framework_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'ultra-framework' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'ultra-framework' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'ultra_framework_entry_footer' ) ) :
/*
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ultra_framework_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ultra-framework' ) );
		if ( $categories_list && ultra_framework_categorized_blog() ) {
			printf( '<span class="cat-links uk-display-block">' . '<i class="uk-icon-file-text"></i>' . ' ' . esc_html__( 'Posted in: %1$s', 'ultra-framework' ) . '</span>' . ' ', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ultra-framework' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links uk-display-block">' . '<i class="uk-icon-tags"></i>' . ' ' . esc_html__( 'Tagged: %1$s', 'ultra-framework' ) . '</span>' . ' ', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">' . '<i class="uk-icon-comments"></i>' . ' ';
		comments_popup_link( esc_html__( 'Leave a comment', 'ultra-framework' ), esc_html__( '1 Comment', 'ultra-framework' ), esc_html__( '% Comments', 'ultra-framework' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'ultra-framework' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link uk-display-block">' . '<i class="uk-icon-edit"></i>' . ' ',
		'</span>'
	);
}
endif;

/*
 * Returns true if a blog has more than 1 category.
 */
function ultra_framework_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ultra_framework_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ultra_framework_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ultra_framework_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ultra_framework_categorized_blog should return false.
		return false;
	}
}

/*
 * Flush out the transients used in ultra_framework_categorized_blog.
 */
function ultra_framework_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ultra_framework_categories' );
}
add_action( 'edit_category', 'ultra_framework_category_transient_flusher' );
add_action( 'save_post',     'ultra_framework_category_transient_flusher' );

if ( ! function_exists( 'ultra_framework_the_custom_logo' ) ) :
/*
 * Displays the optional custom logo.
 */
function ultra_framework_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
} 
endif;

if ( ! function_exists( 'ultra_framework_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function ultra_framework_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'ultra-framework' ),
		'next_text' => __( 'Next &rarr;', 'ultra-framework' ),
		'type'		=> 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'ultra-framework' ); ?></h1>
		<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'ultra_framework_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 */
function ultra_framework_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;


if ( ! function_exists( 'ultra_framework_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 */
	function ultra_framework_excerpt( $class = 'entry-summary uk-margin' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() || is_archive() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;


if ( ! function_exists( 'ultra_framework_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 */
function ultra_framework_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span><span class="meta-nav"> &rarr;</span>', 'ultra-framework' ), get_the_title( get_the_ID() ) )
	);
	return '&hellip; ' . $link;
}
add_filter( 'excerpt_more', 'ultra_framework_excerpt_more' );
endif;