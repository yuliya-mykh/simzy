<?php

function simyz_assets() {
	wp_enqueue_style( 'owlcarousel', get_template_directory_uri().'/css/owl.carousel.min.css' );
	wp_enqueue_style( 'owlcarouseltheme', get_template_directory_uri().'/css/owl.theme.default.min.css' );
	wp_enqueue_style( 'maincss', get_template_directory_uri().'/css/style.css' );

	wp_enqueue_script( 'jqueryscript', get_template_directory_uri().'/js/jquery-3.6.0.min.js', [], '1.0.0', true );
	wp_enqueue_script( 'owlcarouselscript', get_template_directory_uri().'/js/owl.carousel.min.js', [], '1.0.0', true );
	wp_enqueue_script( 'mainscript', get_template_directory_uri().'/js/script.js', [], '1.0.0', true );


}
add_action( 'wp_enqueue_scripts', 'simyz_assets' );


remove_filter( 'the_content', 'wpautop' );remove_filter( 'the_content', 'wpautop' );


add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Primary Menu' );
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}