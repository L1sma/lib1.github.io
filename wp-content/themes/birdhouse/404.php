<?php if ( !defined( 'ABSPATH' ) ) exit;

	get_header();

		?>

			<div id="content-holder" class="sidebar-position-right">
	
				<div id="content-box">
	
					<div>

						<div id="page-404">

							<div id="content-404">

								<h1><?php esc_html_e( "Nothing found", 'birdhouse' ) ?></h1>

								<p>
									<?php esc_html_e( "Sorry, the page you asked for couldn't be found.", 'birdhouse' ) ?>
									<?php esc_html_e( 'Please, try to use the search form below.', 'birdhouse' ) ?>
								</p>

								<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

									<input
										type="text"
										name="s"
										value=""
										placeholder="<?php esc_html_e( 'Search...', 'birdhouse' ) ?>"
									/>

								</form>

							</div>

							<p><?php esc_html_e( "Here's a little map that might help you get back on track:", 'birdhouse' ) ?></p>

							<div class="column" style="width: 52%;">
								<div>
									<h3><?php esc_html_e( 'Categories', 'birdhouse' ) ?></h3>
									<ul><?php wp_list_categories('title_li=&depth=1&show_count=1') ?></ul>
								</div>
							</div>

							<div class="column" style="width: 48%;">
									<h3><?php esc_html_e( 'Archives', 'birdhouse' ) ?></h3>
									<ul><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>

							</div>
		
							<div class="clear"><!-- --></div>

						</div>			

					</div>

				</div><!-- #content-box -->
	
				<?php

					/*-------------------------------------------
						2.8 - Sidebar
					-------------------------------------------*/

					get_sidebar();

				?>

				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
	
		<?php

	get_footer();

?>