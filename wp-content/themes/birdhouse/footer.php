<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$birdhouse_Options,
		$birdhouse_Settings;

		$birdhouse_['copyrights'] = !empty( $birdhouse_Settings['copyrights'] ) ? $birdhouse_Settings['copyrights'] : date( 'Y' ) . ' &copy; ' . esc_attr( get_bloginfo( 'sitename' ) );

		?>

				</div><!-- #content-layout -->
		
			</div><!-- #content -->

			<div class="clear"><!-- --></div>

			<?php

				// Sidebar Ad C
				if ( is_active_sidebar( 'ad-sidebar-3' ) ) {
					get_template_part( '/includes/sidebars/sidebar_ad_c' ); }

			?>

			<div id="footer">

				<div id="footer-layout">

					<div id="footer-holder">
				
						<?php

							// Footer Sidebars
							get_template_part( '/includes/sidebars/sidebar_footer' );

						?>
	
					</div><!-- #footer-holder -->

					<div id="copyrights-holder">

						<div id="copyrights-box">
					
							<?php
							
								// Company copyrights
								echo '<div id="copyrights-company">' . wp_kses( $birdhouse_['copyrights'], $birdhouse_Options['tags_allowed'] ) . '</div>';
						
								// Developer copyrights
								if ( !isset( $birdhouse_Settings['dev_link'] ) || empty( $birdhouse_Settings['dev_link'] ) && $birdhouse_Settings['dev_link'] != 'no' ) {
									echo '<div id="copyrights-developer">' . esc_html(  $birdhouse_Options['general']['label'] ) . ' theme by <a href="' . esc_url( $birdhouse_Options['general']['developer-url'] ) . '">' . esc_html( $birdhouse_Options['general']['developer'] ) . '</a></div>'; }

							?>

							<div class="clear"><!-- --></div>

						</div><!-- #copyrights-box -->
					
					</div><!-- #copyrights-holder -->

				</div><!-- #footer-layout -->

			</div><!-- #footer -->

		</div><!-- #layout -->

		<?php
		
			wp_footer();

		?>

	</body>

</html>