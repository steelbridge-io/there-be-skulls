<?php

/**
 * Theme Functions
 *
 * @package ThereBeSkulls
 */

function your_theme_setup() {
  // Add support for post thumbnails
  add_theme_support('post-thumbnails');

  // Register a menu
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'your-theme-name'),
  ));
}
add_action('after_setup_theme', 'your_theme_setup');

// Adds customizer code
require get_template_directory() . '/customizer/general-customizer.php';
require get_template_directory() . '/customizer/frontpage-customizer.php';
require get_template_directory() . '/inc/custom-login.php';
// Register footer widgets
require get_template_directory() . '/inc/footer-widgets.php';

if (!function_exists('there_be_skulls_enqueue_styles')) {
  /**
   * Enqueue theme styles.
   */
  function there_be_skulls_enqueue_styles() {
    /** Styles */
    wp_enqueue_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0', 'all');
    wp_enqueue_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css');
    // Enqueue the main stylesheet.
    wp_enqueue_style('there_be_skulls-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    /** Scripts */
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'there_be_skulls_enqueue_styles');

function custom_login_enqueue_styles() {
  wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/css/custom-login.css');
}
add_action('login_enqueue_scripts', 'custom_login_enqueue_styles');

function skulls_customizer_styles() {
  wp_enqueue_style('customizer-styles', get_template_directory_uri() . '/customizer/css/customizer-styles.css', array(), '1.0.0', 'all');
}
add_action('customize_controls_enqueue_scripts', 'skulls_customizer_styles');

function there_be_skulls_enqueue_block_editor_assets() {
  wp_enqueue_style('skulls-block-editor-styles', get_theme_file_uri('/assets/css/block-editor-styles.css'), false, '1.0', 'all');
  wp_enqueue_script('skulls-block-editor-scripts', get_theme_file_uri('/assets/js/block-editor-scripts.js'), array('wp-blocks', 'wp-dom'), '1.0', true);
}
add_action('enqueue_block_editor_assets', 'there_be_skulls_enqueue_block_editor_assets');


// Full Site Editing (FSE) support
add_theme_support('block-template-parts');
add_theme_support('align-wide');
add_theme_support('editor-styles');
add_editor_style('style-editor.css'); // Add this file for editor-specific styling

// WooCommerce product gallery support
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');


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

/** Admin enqueue scripts */
function mytheme_conditional_enqueue_scripts() {
  // Do not enqueue 'wp-editor' in the widgets block editor or customizer
  if (is_admin() && (is_customize_preview() || isset($_GET['action']) && $_GET['action'] === 'edit')) {
    return;
  }
}
add_action('admin_enqueue_scripts', 'mytheme_conditional_enqueue_scripts', 20);

function mytheme_disable_conflicting_scripts() {
  if (is_customize_preview() || isset($_GET['action']) && $_GET['action'] === 'edit') {
    wp_dequeue_script('woocommerce-admin');
  }
  // Check if the current screen is the new widget editor or the customizer
  $current_screen = get_current_screen();

  if ($current_screen && ($current_screen->id === 'widgets' || $current_screen->id === 'customize')) {
    // Dequeue wp-editor script if we're in the block-based widget editor or customizer
    wp_dequeue_script('wp-editor');
  }
}
add_action('admin_enqueue_scripts', 'mytheme_disable_conflicting_scripts', 20);


