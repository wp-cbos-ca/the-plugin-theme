<?php
/*
Plugin Name:    Theme: 8200-RGB-Green
Plugin URI:     https://wp.cbos.ca/theme/plugins/green/
Description:    Green.
Version:        2015.11.25
License:        GPLv2+
*/ 

defined( 'ABSPATH' ) || die();

add_action( 'wp_enqueue_scripts', 'enqueue_theme_green', 50 );

function enqueue_theme_green() {
    global $delivered;
    if ( in_array( $delivered, array( 'd', 't' ) ) ) {
        wp_enqueue_style( 'theme-green', plugin_dir_url(__FILE__) . 'css/style.css', array(), time() );
    }
}
