<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - START

		1.1 - Theme Options
		1.2 - Theme Settings
		1.3 - Framework

*/

/*= 1 ===========================================

	S T A R T
	The start point is here.

===============================================*/

	/*-------------------------------------------
		Theme Options:
		Global options come by default.
	-------------------------------------------*/

	include( get_template_directory() . '/options.php' );


	/*-------------------------------------------
		Theme Settings:
		Unique settings created by admin.
	-------------------------------------------*/

	$birdhouse_Settings = function_exists( 'st_kit' ) ? get_option( $birdhouse_Options['general']['name'] . 'settings' ) : array();


	/*-------------------------------------------
		Framework:
		A common functions.
	-------------------------------------------*/

	include ( get_template_directory() . '/framework/start.php' );


?>