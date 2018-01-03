<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - INCLUDINGS

		1.1 - Check ST Kit compatibility
		1.2 - Functions
		1.3 - Register: CSS
		1.4 - Register: JS
		1.5 - Register: Menu
		1.6 - Register: Sidebars
		1.7 - Comment Callback
		1.8 - TGM

*/

/*= 1 ===========================================

	I N C L U D I N G S
	Required includings

===============================================*/

	global
		$birdhouse_Options,
		$birdhouse_Settings;

		$birdhouse_ = array();



	/*-------------------------------------------
		1.1 - Checking of compatibility
	-------------------------------------------*/

	if ( is_admin() ) {
		require( get_template_directory() . '/framework/functions/checking.php' ); }



	/*-------------------------------------------
		1.2 - Functions
	-------------------------------------------*/

	require( get_template_directory() . '/framework/functions/global.php' );



	/*-------------------------------------------
		1.3 - Register: CSS
	-------------------------------------------*/

	require( get_template_directory() . '/framework/functions/register-css.php' );



	/*-------------------------------------------
		1.4 - Register: JS
	-------------------------------------------*/

	require( get_template_directory() . '/framework/functions/register-js.php' );



	/*-------------------------------------------
		1.5 - Register: Menu
	-------------------------------------------*/

	require( get_template_directory() . '/framework/functions/register-menu.php' );



	/*-------------------------------------------
		1.6 - Register: Sidebars
	-------------------------------------------*/

	require( get_template_directory() . '/framework/functions/register-sidebars.php' );



	/*-------------------------------------------
		1.7 - Comment Callback
	-------------------------------------------*/

	if ( !is_admin() ) {

		require( get_template_directory() . '/includes/comments/comment.php' );
		require( get_template_directory() . '/includes/comments/pingback.php' );

	}



	/*-------------------------------------------
		1.8 - TGM
	-------------------------------------------*/

	if ( is_admin() ) {
		require( get_template_directory() . '/framework/functions/register-tgm.php' ); }



?>