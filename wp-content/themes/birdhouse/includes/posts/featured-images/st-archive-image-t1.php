<?php

	$birdhouse_['thumb_id'] = get_post_thumbnail_id( $post->ID );
	$birdhouse_['birdhouse-project-medium'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-project-medium', true );
	$birdhouse_['birdhouse-project-medium-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-project-medium-2x', true ) : '';
	$birdhouse_['birdhouse-post-image'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-post-image', true );
	$birdhouse_['birdhouse-post-image-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-post-image-2x', true ) : '';
	

	echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';?>

		<picture>
			<source media="(max-width: 479px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
			<source media="(max-width: 639px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
			<source media="(max-width: 959px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
			<source media="(max-width: 1299px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
			<source media="(min-width: 1300px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
			<img src="<?php echo $birdhouse_['birdhouse-post-image'][0] ?>" alt="<?php the_title() ?>" />
		</picture>

	<?php echo '</a>';

?>