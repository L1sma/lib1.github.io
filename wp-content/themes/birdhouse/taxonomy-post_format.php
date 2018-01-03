<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - POSTS

		1.1 - Breadcrumbs
		1.2 - If
			- Date
			- Tag
			- Category
		1.3 - Loop
			- Pagination
		1.4 - Sidebar Secondary
		1.5 - Sidebar Default

	2 - 404

		2.1 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$birdhouse_Options,
		$birdhouse_Settings;

		$birdhouse_ = array();
		$birdhouse_['args'] = array();

		$birdhouse_['count'] = 0;


/*===============================================

	P O S T S
	Display default posts archive

===============================================*/

	get_header();


		if ( have_posts() ) {
	
			/*-----------------------------------------------
				Retrieve data
			-----------------------------------------------*/
	
			// Template name
			$birdhouse_['t'] = esc_html( !empty( $birdhouse_Settings['blog_template'] ) ? $birdhouse_Settings['blog_template'] : 'default' );
	
			// Get sidebar position
			$birdhouse_['sidebar_position'] = 'right';
	
			// Re-define content width
			$content_width = esc_html( $birdhouse_Options['global']['images']['birdhouse-archive-image']['width'] ); ?>
	
				<div id="content-holder" class="sidebar-position-<?php echo esc_html( $birdhouse_['sidebar_position'] ); ?>">

					<?php

						/*-------------------------------------------
							1.1 - Breadcrumbs
						-------------------------------------------*/
	
						/* no needed */
	
	
	
						/*-------------------------------------------
							1.2 - Title
						-------------------------------------------*/
	
							/*--- Date -----------------------------*/
	
							if ( is_day() || is_month() || is_year() ) {
	
								// Get the date
								if ( is_day() ) :
		
									$birdhouse_['date'] = get_the_date();
									$birdhouse_['y'] = get_the_date('Y');
									$birdhouse_['n'] = get_the_date('n');
									$birdhouse_['j'] = get_the_date('j');
	
									$birdhouse_['qty'] = get_posts( 'year=' . $birdhouse_['y'] . '&monthnum=' . $birdhouse_['n'] . '&day=' . $birdhouse_['j'] . '&posts_per_page=-1' );
									$birdhouse_['qty'] = count( $birdhouse_['qty'] );
	
								elseif ( is_month() ) :
	
									$birdhouse_['date'] = get_the_date( 'F Y' );
									$birdhouse_['y'] = get_the_date('Y');
									$birdhouse_['n'] = get_the_date('n');
	
									$birdhouse_['qty'] = get_posts( 'year=' . $birdhouse_['y'] . '&monthnum=' . $birdhouse_['n'] . '&posts_per_page=-1' );
									$birdhouse_['qty'] = count( $birdhouse_['qty'] );
	
								elseif ( is_year() ) :
		
									$birdhouse_['date'] = get_the_date( 'Y' );
									$birdhouse_['y'] = get_the_date('Y');
	
									$birdhouse_['qty'] = 0;
	
										$birdhouse_['array'] = array(1,2,3,4,5,6,7,8,9,10,11,12);
	
										foreach ( $birdhouse_['array'] as $birdhouse_['value'] ) {
	
											$birdhouse_['a'] = count( get_posts( 'year=' . $birdhouse_['y'] . '&monthnum=' . $birdhouse_['value'] . '&posts_per_page=-1' ) );
											$birdhouse_['qty'] = $birdhouse_['qty'] + $birdhouse_['a'];
	
										}
	
								endif;
	
								$birdhouse_['out_title'] = esc_html( $birdhouse_['date'] ) . ' <span class="title-sub">' . esc_html( $birdhouse_['qty'] ) . '</span>';
	
							}
	
	
							/*--- Tag -----------------------------*/
	
							elseif ( is_tag() ) {
	
								// Get number of posts by tag
								$birdhouse_['term'] = get_term_by( 'name', single_tag_title( '', false ), 'post_tag' );
	
								$birdhouse_['out_title'] = esc_html( single_tag_title( '', false ) ) . ' <span class="title-sub">' . $birdhouse_['term']->count . '</span>';
	
								if ( tag_description() ) {
									$birdhouse_['out_description'] = tag_description(); }
	
							}
	
	
							/*--- Category -----------------------------*/
	
							elseif ( is_category() ) {
	
								$birdhouse_['category'] = get_queried_object();
	
								$birdhouse_['out_title'] = $birdhouse_['category']->name . ' <span class="title-sub">' . $birdhouse_['category']->count . '</span>';
	
								if ( $birdhouse_['category']->category_description ) {
									$birdhouse_['out_description'] = $birdhouse_['category']->category_description; }
	
							}
	
	
							/*--- Format -----------------------------*/
	
							elseif ( get_queried_object()->taxonomy == 'post_format' ) {
	
								foreach ( $birdhouse_Options['global']['post-formats'] as $birdhouse_['format'] => $birdhouse_['label'] ) {
									if ( get_queried_object()->slug == 'post-format-' . $birdhouse_['format'] ) {
										$birdhouse_['out_title'] = esc_html( $birdhouse_['label']['label'] ) . ' <span class="title-sub">' . get_queried_object()->count . '</span>'; }
								}
	
							}
	
	
						if ( !empty($birdhouse_['out_title']) ) {
	
							echo
								'<div id="term">' .
									'<div class="term-title"><h1>' . ucwords($birdhouse_['out_title']) . '</h1></div>' .
									( !empty($birdhouse_['out_description']) ? '<div class="term-description">' . wp_kses( $birdhouse_['out_description'], $birdhouse_Options['tags_allowed'] ) . '</div>' : '' ) .
								'</div>';
	
						}

					?>

					<div id="content-box">
	
						<div>
	
							<div>
	
								<?php
	
									/*-------------------------------------------
										1.3 - Author's vcard
									-------------------------------------------*/
	
									if ( is_author() ) {

										include( locate_template( '/includes/posts/formats/status.php' ) );

									}
	
	
	
									/*-------------------------------------------
										1.3 - Loop
									-------------------------------------------*/

									echo '<div class="' . ( $birdhouse_['sidebar_position'] == 'none' && ( $birdhouse_['t'] == 't6' || $birdhouse_['t'] == 't10' || $birdhouse_['t'] == 't11' ) ? 'v2' : 'v1' ) . '">';


										while ( have_posts() ) : the_post();
		
											$birdhouse_['count']++;
		
											include( locate_template( '/includes/posts/' . $birdhouse_['t'] . '.php' ) );

										endwhile;
		
		
										echo '<div class="clear"><!-- --></div>';
		
		
										// Pagination
										if ( function_exists('wp_pagenavi') ) {
											?><div id="wp-pagenavibox"><?php wp_pagenavi(); ?></div><?php } 
										else {
											?><div id="but-prev-next"><?php next_posts_link( esc_html__( 'Older posts', 'birdhouse' ) ); previous_posts_link( esc_html__( 'Newer posts', 'birdhouse' ) ); ?></div><?php } 


									echo '<div class="clear"><!-- --></div></div>';

	
	
								?>
		
								<div class="clear"><!-- --></div>
		
							</div>
	
							<?php
	
								/*-------------------------------------------
									1.4 - Sidebar Secondary
								-------------------------------------------*/
	
								if ( !isset( $birdhouse_['sidebar_position'] ) || !empty( $birdhouse_['sidebar_position'] ) && $birdhouse_['sidebar_position'] != 'none' ) {
									st_get_sidebar( 'Secondary Sidebar' ); }
	
							?>
	
							<div class="clear"><!-- --></div>
	
						</div>
	
					</div><!-- #content-box -->
	
					<?php
	
						/*-------------------------------------------
							1.5 - Sidebar Default
						-------------------------------------------*/
	
						get_sidebar();
	
					?>
	
					<div class="clear"><!-- --></div>
	
				</div><!-- #content-holder -->
	
			<?php
	
		}
	
		else {
	
			?>
	
				<div id="content-holder" class="arch sidebar-position-right">
	
					<div id="content-box">
	
						<div>
	
							<div>
	
								<?php esc_html_e( 'Sorry, no posts matched your criteria.', 'birdhouse' ) ?>
	
								<div class="clear"><!-- --></div>
	
							</div>
	
						</div>
	
					</div><!-- #content-box -->
	
					<?php
	
						/*-------------------------------------------
							3.1 - Sidebar Default
						-------------------------------------------*/
	
						get_sidebar();
	
						/*-------------------------------------------
							3.2 - Sidebar Secondary
						-------------------------------------------*/
	
						st_get_sidebar( 'Secondary Sidebar' );
	
					?>
	
					<div class="clear"><!-- --></div>
	
				</div><!-- #content-holder -->
		
			<?php
	
		}


	get_footer();


?>