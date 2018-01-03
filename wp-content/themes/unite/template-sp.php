<?php
/*
Template Name: Шаблон спектаклей
*/

get_header(); ?>

	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
		
<?php 
			
			$args = array(
                   'post_type' => 'performance',
                   'publish' => true,
                   
               );
            
            query_posts($args);
			
			
			while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
