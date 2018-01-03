<?php
/**
 * Template part for displaying results in search pages.
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('uk-article uk-margin-large-bottom'); ?>>
	<header class="entry-header uk-margin">
		<?php the_title( sprintf( '<h2 class="entry-title uk-text-center-small"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta uk-article-meta uk-text-center-small">
			<?php ultra_framework_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<?php ultra_framework_post_thumbnail(); ?>

	<?php ultra_framework_excerpt(); ?>

	<footer class="entry-footer">
		<?php ultra_framework_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
