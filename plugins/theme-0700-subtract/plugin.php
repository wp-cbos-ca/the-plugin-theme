<?php
/*
Plugin Name:    Theme: 0700-Subtract
Plugin URI:     https://wp.cbos.ca/theme/plugins/subtract/
Description:    Subtract the things you don't want.
Version:        2015.11.25
License:        GPLv2+
*/ 

defined( 'ABSPATH' ) || die();
 
function unregister_categories_for_posts(){
	global $wp_taxonomies;
	$taxonomy = 'category';
	if ( taxonomy_exists( $taxonomy ) ) {
		unset( $wp_taxonomies[ $taxonomy ] );
	}
}
add_action( 'init', 'unregister_categories_for_posts');

function remove_admin_menus() {
	remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_admin_menus' );

function remove_toolbar_menus() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'new-post' );
}
add_action( 'wp_before_admin_bar_render', 'remove_toolbar_menus' );

function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
