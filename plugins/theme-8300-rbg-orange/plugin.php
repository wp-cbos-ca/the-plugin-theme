<?php
/*
Plugin Name:    Theme: 8300-RBG-Orange
Plugin URI:     https://wp.cbos.ca/theme/plugins/orange/
Description:    Orange.
Version:        2015.11.25
License:        GPLv2+
*/ 

defined( 'ABSPATH' ) || die();

add_action( 'wp_enqueue_scripts', 'enqueue_theme_orange', 50 );

function enqueue_theme_orange() {
    global $device;
    if ( ! empty ( $device ) && $device != 'm' ) {
        wp_enqueue_style( 'theme-orange', plugin_dir_url(__FILE__) . 'css/style.css', array(), time() );    
    }
}
