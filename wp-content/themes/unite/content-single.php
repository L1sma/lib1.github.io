<?php 
  $order1 = get_post_meta($post->ID, 'order', true);
  $kind1 = get_post_meta($post->ID, 'kind', true);
  
 ?>


<?php
/**
 * @package unite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header page-header">

		<?php 
                    if ( of_get_option( 'single_post_image', 1 ) == 1 ) :
                        the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' )); 
                    endif;
                  ?>

		<h3 class="entry-title "><?php the_title(); ?></h3>

		<div class="entry-meta">
			<?php unite_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

     
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
				'after'  => '</div>',
			) );
		?>
		<label><i class="fa fa-money" aria-hidden="true"></i><strong>   Стоимость:</strong>  <?php  echo $order1  ?></label>
		<label><i class="fa fa-calendar" aria-hidden="true"></i><strong>   Дата премьеры:</strong>  <?php  echo $kind1  ?></label>
		
		
		
		
		<?php  

$taxo_text = "";  

  $act_list = get_the_term_list( $post->ID, 'actors', '<i class="fa fa-users" aria-hidden="true"></i><strong>   Актеры(ы):</strong> ', ', ', '' );  
  $theatr_list = get_the_term_list( $post->ID, 'theaters', '<i class="fa fa-university" aria-hidden="true"></i><strong>   Театр(ы):</strong> ', ', ', '' );  
  $gen_list = get_the_term_list( $post->ID, 'genres', '<i class="fa fa-tags" aria-hidden="true"></i><strong>   Жанр(ы):</strong> ', ', ', '' );  
  if ( '' != $act_list ) {  
    $taxo_text .= "$act_list<br />\n";  }
   if ( '' != $act_list ) {  
    $taxo_text .= "$theatr_list<br />\n";  }
	 if ( '' != $gen_list ) {  
    $taxo_text .= "$gen_list<br />\n";  }
	
	
if ( '' != $taxo_text ) {  
?>  
<div class="entry-utility">  
<?php  echo $taxo_text;  ?>  
</div>  
<?  
} 
?> 
		
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'unite' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'unite' ) );

			if ( ! unite_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
				 
			);
		?>

		<?php edit_post_link( __( 'Edit', 'unite' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
		<?php unite_setPostViews(get_the_ID()); ?>
		<hr class="section-divider">
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
