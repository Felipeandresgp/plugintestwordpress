<?php
/*
Plugin Name: Test Plugin
Description: Plugin de prueba para el cargo de desarrollador web
Version: 1.0
Author: Felipe Gonzalez
Author URI: https://felipeandresgp.github.io/
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

function shortcode() { 

    $message = '<p>Hello Ilumno</p>';

    return $message;
}

add_shortcode('test_add_message', 'shortcode');

function autopage() {
    $testwp = array(
        'post_title'    => 'Prueba de Wordpress',
        'post_content'  => '[test_add_message]',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_name'     => 'test_wordpress'
      );

    wp_insert_post( $testwp );
}

register_activation_hook(__FILE__,'autopage');

function deactivate () {             
    $args = array(
        'post_type'      => 'page', 
        'posts_per_page' => - 1
    );

    if ( $posts = get_posts( $args ) ) {
        foreach ( $posts as $post ) {
            wp_delete_post( $post->ID, true );
        }
    }
}

register_deactivation_hook(__FILE__,'deactivate');
