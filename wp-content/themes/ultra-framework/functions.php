<?php
/**
 * Ultra Framework functions and definitions.
 */

if ( ! function_exists( 'ultra_framework_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ultra_framework_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ultra Framework, use a find and replace
	 * to change 'ultra-framework' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ultra-framework', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 840, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'ultra-framework' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ultra_framework_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    /**
	 * Add editor styles
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/custom-fonts.css' ) );
}
endif;
add_action( 'after_setup_theme', 'ultra_framework_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function ultra_framework_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ultra_framework_content_width', 840 );
}
add_action( 'after_setup_theme', 'ultra_framework_content_width', 0 );

/**
 * Register widget area.
 */
function ultra_framework_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ultra-framework' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ultra-framework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s uk-panel uk-text-center-small">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title uk-panel-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ultra_framework_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ultra_framework_scripts() {
    
    if ( is_rtl() ) {
        wp_enqueue_style( 'uikit-rtl', get_template_directory_uri() . '/css/uikit-rtl.css' );
    } else {
        wp_enqueue_style( 'uikit', get_template_directory_uri() . '/css/uikit.css' );
    }
	
	wp_enqueue_style( 'ultra_framework-custom-fonts', get_template_directory_uri() . '/fonts/custom-fonts.css' );
	
	wp_enqueue_style( 'ultra-framework-style', get_stylesheet_uri() );

	wp_enqueue_script( 'uikit-js', get_template_directory_uri() . '/js/uikit.js', array( 'jquery' ), '20160526', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'ultra_framework_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*
 * Custom menu nav walker.
 */
require get_template_directory() . '/inc/nav-walker.php';