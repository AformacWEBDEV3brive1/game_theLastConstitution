<?php

function display_hello()

{

    echo 'test de function hello';

}

function theme_styles() {

	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap-theme.min.css' );
	//wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'theme_styles');


function theme_js() {

	global $wp_scripts;

	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
	//wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/js/scripts.js');

}

add_action( 'wp_enqueue_scripts', 'theme_js');
?>
