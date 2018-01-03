<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - REGISTER JS

		1.1 - Common

			- jquery.st.js

		1.2 - Other scripts

			- owl.carousel.min.js

*/

	if ( !is_admin() ) {

		function st_theme_scripts() {
	
			global
				$birdhouse_Options,
				$birdhouse_Settings;


			/*-------------------------------------------
				1.1 - Common scripts
			-------------------------------------------*/

			if ( $birdhouse_Options['js']['st'] ) {
				wp_enqueue_script( 'birdhouse-jquery-st', get_template_directory_uri() . '/framework/assets/js/jquery.st.js', array('jquery'), null, true ); }


			/*-------------------------------------------
				1.2 - Other scripts
			-------------------------------------------*/

			if ( function_exists('st_kit') && $birdhouse_Options['js']['owl'] ) {
				wp_enqueue_script( 'jquery-owl', plugins_url() . '/stkit/assets/plugins/owl/js/owl.carousel.min.js', array('jquery'), null, true ); }

			if ( is_singular() && !empty( $birdhouse_Options['js']['comment'] ) ) {
				wp_enqueue_script( 'comment-reply' ); }

		}
	
		add_action( 'wp_enqueue_scripts', 'st_theme_scripts' );

	}


?>