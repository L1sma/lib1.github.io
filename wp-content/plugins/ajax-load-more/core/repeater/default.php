<li<?php if (! has_post_thumbnail() ) { echo ' class="no-img"'; } ?>>
	<?php
   	if ( has_post_thumbnail() ) {
   		the_post_thumbnail('alm-thumbnail');
   	}
	?>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
	<?php the_content(); ?>
</li>