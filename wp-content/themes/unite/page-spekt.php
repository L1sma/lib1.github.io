 <?php 
  $order = get_post_meta($post->ID, 'Стоимость билета', true);
 
 ?>

<?php
/*
Template Name: Шаблон спектаклей
*/

 get_header(); ?>
<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
		<?php
		    $loop = new WP_Query( array( 'post_type' => array('spekt')) );
		    if ( $loop->have_posts() ) :
		        while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php get_template_part('loop-spekt'); ?>
		    <?php endwhile; ?>
		    <?php endif; wp_reset_postdata(); ?>
			
    </div>
</div>
<?php echo $order?>

<?php get_footer(); ?>




