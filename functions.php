<?php

/**
 * Theme Functions
 *
 * @package ThereBeSkulls
 */


function your_theme_setup() {
	// Add support for post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Register a menu
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'your-theme-name' ),
	) );
}

add_action( 'after_setup_theme', 'your_theme_setup' );

if ( ! function_exists( 'there_be_skulls_enqueue_styles' ) ) {
	/**
	 * Enqueue theme styles.
	 */
	function there_be_skulls_enqueue_styles() {
		
		/** Styles */
		wp_enqueue_style( 'bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
			array(), '5.3.0', 'all' );
		wp_enqueue_style( 'bootstrap-icons',
			'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css' );
		// Enqueue the main stylesheet.
		wp_enqueue_style( 'there_be_skulls-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
		
		/** Scripts */
		wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true );
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true );
	}

}
add_action( 'wp_enqueue_scripts', 'there_be_skulls_enqueue_styles' );

function add_custom_body_class($classes) {
	// Add the 'text-light' class to the body classes array
	$classes[] = '';
	return $classes;
}
add_filter('body_class', 'add_custom_body_class');

function skulls_theme_woocommerce_support() {
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'skulls_theme_woocommerce_support');

function add_livereload_script() {
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) { // Only add live reload script for local development
		wp_enqueue_script('livereload', 'http://localhost:35729/livereload.js', array(), null, true);
	}
}
add_action('wp_enqueue_scripts', 'add_livereload_script');

/**
 *  Bootstrap 5 WordPress Navbar Walker
 */
include_once get_template_directory() . '/inc/bootstrap-5-wordpress-navbar-walker.php';

register_nav_menu('main-menu', 'Main menu');