<?php
/**
 * The template for displaying archive pages.
 */

get_header(); ?>

	<div id="primary" class="content-area uk-width-medium-3-4">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title uk-text-center-small">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description uk-text-center-small">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

			ultra_framework_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
