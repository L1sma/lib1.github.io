<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - CHECKING

		1.1 - ST Kit compatibility

*/

/*===============================================

	C H E C K I N G
	Compatibility

===============================================*/

	/*-------------------------------------------
		1.1 - ST Kit compatibility
	-------------------------------------------*/

	global
		$birdhouse_Options;

		// If ST Kit plugin exists, then load its options
		if ( file_exists( WP_PLUGIN_DIR . '/stkit/options.php' ) ) {
			include ( WP_PLUGIN_DIR . '/stkit/options.php' );
		}
		else {
			return;
		}

		if ( !empty( $birdhouse_Kit ) && isset( $birdhouse_Options['general']['stkit-min'] ) && version_compare( $birdhouse_Kit['version'], $birdhouse_Options['general']['stkit-min'] ) < 0 ) {

			$kit['plugins-page'] = 'plugins.php';

			$birdhouse_['message'] = wp_kses( __( "You're using <strong>ST Kit</strong> plugin v.%1\$s, however <strong>%2\$s</strong> theme requires <strong>ST Kit</strong> v.%3\$s or higher. Update ST Kit from within <a href='%4\$s'>Plugins</a> page.", 'birdhouse' ), $birdhouse_Options['tags_allowed'] );
			
			$birdhouse_['fallback_theme_notice'] = sprintf( $birdhouse_['message'], esc_html( $birdhouse_Kit['version'] ), esc_html( $birdhouse_Options['general']['label'] ), esc_html( $birdhouse_Options['general']['stkit-min'] ), $kit['plugins-page'] );

			add_action( 'admin_notices', 'st_fallback_theme_notice' );

		}

?>