<?php
/**
 * Ultra Framework Theme Customizer.
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
function ultra_framework_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'ultra_framework_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ultra_framework_customize_preview_js() {
	wp_enqueue_script( 'ultra_framework_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ultra_framework_customize_preview_js' );
