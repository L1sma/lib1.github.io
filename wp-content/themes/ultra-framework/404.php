<?php
/**
 * The template for displaying 404 pages (not found).
 */

get_header(); ?>

	<div id="primary" class="content-area uk-width-medium-3-4">
		<main id="main" class="site-main" role="main">

			<?php get_template_part('template-parts/content', 'none'); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
