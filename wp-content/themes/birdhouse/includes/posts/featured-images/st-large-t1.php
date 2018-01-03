<?php

	$birdhouse_['thumb_id'] = get_post_thumbnail_id( $post->ID );
	$birdhouse_['birdhouse-project-medium'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-project-medium', true );
	$birdhouse_['birdhouse-project-medium-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-project-medium-2x', true ) : '';
	$birdhouse_['birdhouse-post-image'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-post-image', true );
	$birdhouse_['birdhouse-post-image-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-post-image-2x', true ) : '';
	$birdhouse_['birdhouse-archive-image'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-archive-image', true );
	$birdhouse_['birdhouse-archive-image-2x'] = !empty( $birdhouse_Settings['hidpi'] ) != 'no' ? wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'birdhouse-archive-image-2x', true ) : '';


	if ( is_single() || is_page() ) {

		$birdhouse_['st-image-original'] = wp_get_attachment_image_src( $birdhouse_['thumb_id'], 'st-original', true );

		echo '<a href="' . esc_url( ( $birdhouse_['st-image-original'][0] ) ) . '" title="' . get_the_title() . '">';

			// Without sidebar
			if ( $birdhouse_['sidebar_position'] == 'none' ) {	?>
				<picture>
					<source media="(max-width: 479px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
					<source media="(max-width: 639px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
					<source media="(max-width: 959px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
					<source media="(max-width: 1299px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-archive-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-archive-image-2x'] ? ', ' . $birdhouse_['birdhouse-archive-image-2x'][0] . ' 2x' : ''; ?>">
					<source media="(min-width: 1300px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-archive-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-archive-image-2x'] ? ', ' . $birdhouse_['birdhouse-archive-image-2x'][0] . ' 2x' : ''; ?>">
					<img class="st-large-t1" src="<?php echo $birdhouse_['birdhouse-archive-image'][0] ?>" alt="<?php the_title() ?>" />
				</picture><?php
			}
			// With Sidebar
			else { ?>
				<picture>
					<source media="(max-width: 479px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
					<source media="(max-width: 639px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
					<source media="(max-width: 959px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
					<source media="(max-width: 1299px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
					<source media="(min-width: 1300px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-archive-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-archive-image-2x'] ? ', ' . $birdhouse_['birdhouse-archive-image-2x'][0] . ' 2x' : ''; ?>">
					<img class="st-large-t1" src="<?php echo $birdhouse_['birdhouse-archive-image'][0] ?>" alt="<?php the_title() ?>" />
				</picture><?php
			}

		echo '</a>';

		return;

	}


	if ( !is_page() && !is_single() ) {
		echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">'; } ?>

		<picture>
			<source media="(max-width: 479px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
			<source media="(max-width: 639px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-project-medium'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-project-medium-2x'] ? ', ' . $birdhouse_['birdhouse-project-medium-2x'][0] . ' 2x' : ''; ?>">
			<source media="(max-width: 959px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
			<source media="(max-width: 1299px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-post-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-post-image-2x'] ? ', ' . $birdhouse_['birdhouse-post-image-2x'][0] . ' 2x' : ''; ?>">
			<source media="(min-width: 1300px)" type="image/jpg" srcset="<?php echo $birdhouse_['birdhouse-archive-image'][0] . ' 1x' ?><?php echo $birdhouse_['birdhouse-archive-image-2x'] ? ', ' . $birdhouse_['birdhouse-archive-image-2x'][0] . ' 2x' : ''; ?>">
			<img class="st-large-t1" src="<?php echo $birdhouse_['birdhouse-archive-image'][0] ?>" alt="<?php the_title() ?>" />
		</picture><?php
		
	if ( !is_page() && !is_single() ) {
		echo '</a>'; }


?>