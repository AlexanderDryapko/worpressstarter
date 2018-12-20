<?php
//Hide admin bar
show_admin_bar( false );

require_once( 'class-wp-bootstrap-navwalker.php' );

//Register menu
register_nav_menus( array(
	'main' => 'Main Menu',
) );

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'menus' );
}
add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery' ) );
add_theme_support( 'post-thumbnails' );

//Load assets
function my_assets() {
	if ( ! is_page( 'contact' ) ) {
		wp_deregister_script( 'jquery' );
		wp_deregister_style( 'contact-form-7' );
		wp_deregister_script( 'contact-form-7' );
	}

	wp_enqueue_script( 'vendors', get_template_directory_uri() . '/js/vendor.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'index', get_template_directory_uri() . '/js/index.min.js', array(), '1.0.0', true );

	wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_enqueue_scripts', 'my_assets' );

//Add SVG media support
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

$acf_opt_args = array(
	'page_title' => 'Theme Settings',
	'menu_title' => 'Theme Settings',
	'icon_url'   => 'dashicons-hammer',
);
acf_add_options_page( $acf_opt_args );