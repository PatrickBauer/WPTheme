<?php
/**
 * base functions and definitions
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 940; /* pixels */
}

if ( ! function_exists( 'base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function base_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on base, use a find and replace
	 * to change 'base' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'base', get_template_directory() . '/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'base' ),
	) );
}
endif; // base_setup
add_action( 'after_setup_theme', 'base_setup' );

/**
 * Register widget area.
 */
function base_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'base' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function base_scripts() {
	wp_enqueue_style( 'base-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'base_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

