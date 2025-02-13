<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'icon_url'      => 'dashicons-tide',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


function theme_relationship_query( $args, $field, $post_id ) {
	
	$args['orderby'] = 'date';
	$args['order'] = 'DESC';
	$args['post_status'] = 'publish'; 

	return $args;

}

add_filter('acf/fields/relationship/query', 'theme_relationship_query', 10, 3);


