<?php
/*
Plugin Name:    Theme: 0500-Setup
Plugin URI:     https://wp.cbos.ca/theme/plugins/setup/
Description:    Theme settings, including default image sizes.
Version:        2015.11.25
License:        GPLv2+
*/ 

defined( 'ABSPATH' ) || die();
 
add_theme_support( 'html5', array( 'search-form' ) );

function the_plugin_theme_setup() {
    add_editor_style();
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
    register_nav_menu( 'primary', 'Primary Menu' );
    register_nav_menu( 'secondary', 'Secondary Menu' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'the_plugin_theme_setup' );

function the_plugin_theme_scripts() {
    wp_enqueue_style( 'plugin-theme', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'the_plugin_theme_scripts' );

function the_plugin_theme_title( $title, $seperator ) {
    global $post;
    $title = get_first_page_title( $post );
    $series = get_post_meta( $post->ID, '_hd_series', true );
    if ( $series ) {
        $title = sprintf( "%s %s %s", $title , $seperator, $series );
    }
    return $title;
}
add_filter( 'wp_title', 'the_plugin_theme_title', 10, 2 );

function get_first_page_title( $post ) {
    if ( get_option('page_on_front') == $post->ID  ) {
        $pages = get_posts( array( 'post_type' => 'hd', 'order' => 'DESC', 'orderby' => 'post_date', 'post_status' => 'publish', 'numberposts' => 1 ) );
        $page = ! empty ( $pages[0] ) ? $pages[0] : '';
    }
    if ( empty ( $page ) && get_option('page_on_front') != $post->ID ) {
        $page = $post;
    } 
    return $page->post_title;    
}

function visit_plugin_site( $plugin_meta ){
    if ( isset( $plugin_meta[1] ) && ! isset( $plugin_meta[2] ) && strpos( $plugin_meta[1], 'https://wp.cbos.ca' ) !==FALSE ) {
        $link = $plugin_meta[1];
        $a = new SimpleXMLElement( $link );
        $url = isset( $a['href'] ) ? ltrim( $a['href'], 'https://' ) : '';
        if ( ! empty ( $url ) ) {
            $plugin_meta[1] = sprintf( '<a href="%s">%s</a>', $a['href'], $url );
        }
    }
    return $plugin_meta;
}
add_filter( 'plugin_row_meta', 'visit_plugin_site' );

function add_device_classes( $classes ) {
    global $delivered;
    
    if ( $delivered == 'm' ) {
        $classes[] = 'mobile';
    }
    else if ( $delivered == 't' ) {
        $classes[] = 'tablet';
    }
    else if ( $delivered == 'd' ) {
        $classes[] = 'desktop';
    }
    else if ( $delivered == 'hd' ) {
        $classes[] = 'hd';
    }
    else { } 
    
    return $classes;
}
add_filter( 'body_class', 'add_device_classes' );

function get_screen_height(){
    $str = '<script>' . PHP_EOL;
    $str .= 'if ( screen.availHeight < 768 ) { ' . PHP_EOL;
    $str .= "   document.getElementsByClassName( '.site-header' ).style.display = 'none'; " . PHP_EOL;
    $str .= '}' . PHP_EOL;
    $str .= '</script>' . PHP_EOL;
    echo $str;
}
add_action( 'wp_head', 'get_screen_height', 100 );
