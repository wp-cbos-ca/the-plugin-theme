<?php
/*
Plugin Name:    Theme: 4300-Images
Plugin URI:     https://wp.cbos.ca/theme/plugins/images/
Description:    Image sizes and additional image functionality.
Version:        2015.11.25
License:        GPLv2+
*/ 

defined( 'ABSPATH' ) || die();
                                                             
function theme_image_sizes() {
    set_post_thumbnail_size( 320, 180 );
}
add_action( 'after_setup_theme', 'theme_image_sizes' );

function theme_image_names( $sizes ) {
    unset( $sizes['thumbnail'] );
    unset( $sizes['medium'] );
    unset( $sizes['full'] );
    $arr = array_merge( $sizes, array(
        'thumbnail' => 'Mobile',
        'full' => 'HD',
    ) );
    return $arr;
}
add_filter( 'image_size_names_choose', 'theme_image_names' );
