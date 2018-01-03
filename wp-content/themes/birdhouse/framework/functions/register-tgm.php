<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - TGM

		1.1 - Include
		1.2 - Textdomain
		1.3 - Hook

*/

/*= 1 ===========================================

	T G M
	Plugin activation class

===============================================*/

	/*-------------------------------------------
		1.1 - Include
	-------------------------------------------*/

	require( get_template_directory() . '/framework/functions/classes/class-tgm-plugin-activation.php' );


	/*-------------------------------------------
		1.2 - Textdomain
	-------------------------------------------*/

	/* n/a */


	/*-------------------------------------------
		1.3 - Hook
	-------------------------------------------*/

	function st_register_required_plugins() {
	
		$plugins = array(

			array(
				'name'     				=> esc_html__( 'Envato Market', 'birdhouse' ),
				'slug'     				=> 'envato-market',
				'source'   				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' 				=> true,
				'version' 				=> '',
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

			array(
				'name'					=> esc_html__( 'WP-PageNavi', 'birdhouse' ),
				'slug'					=> 'wp-pagenavi',
				'required'				=> false,
			),

			array(
				'name'					=> esc_html__( 'WordPress SEO by Yoast', 'birdhouse' ),
				'slug'					=> 'wordpress-seo',
				'required'				=> false,
			),

			array(
				'name'					=> esc_html__( 'Simple Image Widget', 'birdhouse' ),
				'slug'					=> 'simple-image-widget',
				'required'				=> false,
			),

			array(
				'name'					=> esc_html__( 'Instagram Feed', 'birdhouse' ),
				'slug'					=> 'instagram-feed',
				'required'				=> false,
			),

			array(
				'name'					=> esc_html__( 'Newsletter', 'birdhouse' ),
				'slug'					=> 'newsletter',
				'required'				=> false,
			),

			array(
				'name'					=> esc_html__( 'Contact Form 7', 'birdhouse' ),
				'slug'					=> 'contact-form-7',
				'required'				=> false,
			),

			array(
				'name'     				=> esc_html__( 'ST Kit', 'birdhouse' ),
				'slug'     				=> 'stkit',
				'source'   				=> 'http://strictthemes.com/to/download-stkit',
				'required' 				=> true,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

		);
	
		$config = array(
			'id'				=> 'birdhouse',
			'domain'       		=> 'birdhouse',
			'default_path' 		=> '',
			'parent_slug' 		=> 'themes.php',
			'menu'				=> 'tgmpa-install-plugins',
			'has_notices'      	=> true,
			'dismissable'		=> true,
			'dismiss_msg'		=> '',
			'is_automatic'    	=> true,
			'message' 			=> '',
		);
	
		tgmpa( $plugins, $config );
	
	}

	add_action( 'tgmpa_register', 'st_register_required_plugins' );



?>