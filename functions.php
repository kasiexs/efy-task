<?php
/**
 * Child theme functions
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( get_theme_file_path('/inc/trening-post-type.php') );
require_once( get_theme_file_path('/inc/acf-init.php') );
require_once( get_theme_file_path('/inc/efy-custom-endpoint.php') );

/*
Enqueues parent and child stylesheets by default
*/
if ( ! function_exists( 'efy_enqueue_styles' ) ) {
	/**
	 * Enqueue Styles.
	 */
	add_action( 'wp_enqueue_scripts', 'efy_enqueue_styles' );
	function efy_enqueue_styles() {
		// Parent style variable.
		$parent_style = 'twentytwentyfour';

		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
		wp_enqueue_style( 'trening-style', get_stylesheet_directory_uri() . '/build/index.css'  );
		wp_enqueue_script(
			'trening-list',
			get_stylesheet_directory_uri() . '/build/index.js',
			['wp-element'],
			null, 
			true
		  );
	}
}

$acf_integration = new Efy_ACF_Integration(get_stylesheet_directory() . '/inc/acf/', get_stylesheet_directory_uri() . '/inc/acf/');
$acf_integration->initialize();

//ACF Fields for Trening
$trening_fields = new Efy_ACF_Field_Importer(get_stylesheet_directory() . '/inc/acf-fields/trening-acf-fields.json');

//Custom Endpoint for Trening CPT
$trening_endpoint = new Efy_Register_Custom_Endpoint('trening', array('cena', 'krotki_opis', 'czas_trwania', 'termin', 'prowadzacy'));