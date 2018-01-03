<?php
/**
 * Template part for displaying page content in page.php.
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('uk-article uk-margin-large-bottom'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title uk-article-title uk-text-center-small">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	
	<?php ultra_framework_post_thumbnail(); ?>

	<div class="entry-content uk-margin">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ultra-framework' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'ultra-framework' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link uk-display-block"><i class="uk-icon-edit"></i> ',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
