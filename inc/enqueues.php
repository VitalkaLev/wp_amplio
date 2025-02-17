<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function theme_register_styles() {
    wp_enqueue_style('swiper', ASSETS . '/css/swiper-bundle.css', array(), _S_VERSION );
    wp_enqueue_style('fancy', ASSETS . '/css/fancy.min.css', array(), _S_VERSION );

    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11.1.0/swiper-bundle.min.js', array(), false, true );
    wp_enqueue_script('fancy', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), false, true );

    wp_enqueue_style('main', PATH_URL . '/assets/src/css/main.min.css', array(), _S_VERSION );
	wp_enqueue_script('main', PATH_URL . '/assets/src/js/main.js', array(), _S_VERSION, true );

    wp_localize_script('main', 'theme', array(
        'ajax_url' => admin_url('admin-ajax.php'), 
        'nonce' => wp_create_nonce('droneii-nonce') 
    ));
}
add_action( 'wp_enqueue_scripts', 'theme_register_styles' );



function theme_admin_scripts() {
    wp_enqueue_style( 'admin-block', PATH_URL . '/inc/admin/admin-theme.css' ,array(), _S_VERSION , false);
	wp_enqueue_script( 'admin-block', PATH_URL . '/inc/admin/admin-theme.js', array('jquery'), _S_VERSION , true );

}
add_action( 'admin_enqueue_scripts', 'theme_admin_scripts' );