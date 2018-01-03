<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$birdhouse_Options,
		$birdhouse_Settings;

		$birdhouse_['step'] = '2';
		if ( !empty( $_GET['step'] ) ) {
			$birdhouse_['step'] = esc_html( $_GET['step'] ); }

?>
<div class="wrap about-wrap st-about-wrap">
	<div class="st-feature">
		<div>
			<?php
				if ( $birdhouse_['step'] == '2' ) {
					echo sprintf( wp_kses( __( "<h2>Welcome to</h2><h1>%s <span>v.%s</span></h1>", 'birdhouse' ), $birdhouse_Options['tags_allowed'] ), esc_html( $birdhouse_Options['general']['label'] ), esc_html( $birdhouse_Options['general']['version'] ) ); }
				if ( $birdhouse_['step'] == '3' ) {
					echo sprintf( wp_kses( __( "<h2>%s <span>v.%s</span></h2><h1>Setup Process</h1>", 'birdhouse' ), $birdhouse_Options['tags_allowed'] ), esc_html( $birdhouse_Options['general']['label'] ), esc_html( $birdhouse_Options['general']['version'] ) ); }
			?>
			<p><?php echo sprintf( wp_kses( __( "Thank you for choosing the theme created by <a target='_blank' href='http://strictthemes.com/to/portfolio/'>StrictThemes</a> team. Please follow further installation process for getting a clone of <a target='_blank' href='%s'>Demo Site</a>", 'birdhouse' ), $birdhouse_Options['tags_allowed'] ), esc_url( $birdhouse_Options['general']['url-demo'] ) ); ?></p>
		</div>
		<div>
			<img src="<?php echo esc_url( wp_get_theme()->get_screenshot() ) ?>" />
		</div>

	</div>
	<div class="welcome-panel st-welcome-panel">
		<div class="welcome-panel-content">
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<?php
						if ( $birdhouse_['step'] == '2' ) { ?>
							<h3><?php esc_html_e( 'Next Step', 'birdhouse' ) ?> (2/3)</h3>
							<div class="about-text"><?php esc_html_e( "On the next page you'll prompted to install a list of required plugins. Install all of them and go back here.", 'birdhouse' ) ?></div>
							<a href="<?php echo admin_url('themes.php?page=tgmpa-install-plugins') ?>" class="button button-primary button-hero"><?php esc_html_e( 'Go to Plugins', 'birdhouse' ) ?></a><?php
						}
						if ( $birdhouse_['step'] == '3' ) { ?>
							<h3><?php esc_html_e( 'Next Step', 'birdhouse' ) ?> (3/3)</h3>
							<div class="about-text"><?php esc_html_e( "Great! All plugins have been installed. So you can make the final step with Setup Wizard. It will import a dummy content, widgets, menus and all other settings.", 'birdhouse' ) ?></div>
							<a href="<?php echo admin_url('admin.php?page=' . ( strtolower( preg_replace( '#[^a-zA-Z]#','', wp_get_theme()->get( 'Name' ) ) ) ) . '-setup') ?>" class="button button-primary button-hero"><?php esc_html_e( 'Start Setup Wizard', 'birdhouse' ) ?></a><?php
						}
					?>
				</div>
				<div class="welcome-panel-column welcome-panel-column-2">
					<h3><?php esc_html_e( 'Do not forget:', 'birdhouse' ) ?></h3>
					<ul>
						<li><a class="welcome-icon dashicons-facebook" target="_blank" href="https://www.facebook.com/StrictThemes"><?php esc_html_e( 'Follow Us on Facebook', 'birdhouse' ) ?></a></li>
						<li><a class="welcome-icon dashicons-smiley" target="_blank" href="http://themeforest.net/downloads"><?php echo sprintf( esc_html__( "Rate the %s theme", 'birdhouse' ), $birdhouse_Options['general']['label'] ); ?></a></li>
						<li><a class="welcome-icon dashicons-cart" target="_blank" href="http://strictthemes.com/to/<?php echo esc_html( $birdhouse_Options['general']['label'] ) ?>"><?php echo sprintf( esc_html__( "Buy Another License of %s", 'birdhouse' ), esc_html( $birdhouse_Options['general']['label'] ) ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>