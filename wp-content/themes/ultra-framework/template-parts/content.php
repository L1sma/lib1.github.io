<?php
/**
 * Template part for displaying posts.
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('uk-article uk-margin-large-bottom'); ?>>

	<header class="entry-header uk-margin">
		
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'ultra-framework' ); ?></span>
		<?php endif; ?>
		
		
		<?php the_title( '<h2 class="entry-title uk-text-center-small"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta uk-article-meta uk-text-center-small">
			<?php ultra_framework_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	
	
	
	<?php ultra_framework_post_thumbnail(); ?>
	
	<?php ultra_framework_excerpt(); ?>

	<div class="entry-content uk-margin">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ultra-framework' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ultra-framework' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ultra_framework_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
