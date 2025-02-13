<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function add_lazy_loading_to_images($content) {
    if (is_admin()) {
        return $content;
    }

    $content = preg_replace('/<img(?!.*loading=[\'"]?lazy)[^>]+>/i', '$0 loading="lazy"', $content);

    return $content;
}

add_filter('the_content', 'add_lazy_loading_to_images', 99);


function add_lazy_loading_to_wp_get_attachment_image($attr, $attachment, $size) {
    if (!is_admin()) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_lazy_loading_to_wp_get_attachment_image', 10, 3);

/*-- Main Cleanup --*/
function theme_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0 );
	remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('template_redirect', 'rest_output_link_header', 11);
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');

    add_filter('embed_oembed_discover', '__return_false');
}
add_action('init', 'theme_cleanup_head');

function disable_thumbnail_image_sizes() {
    remove_image_size('medium');
    remove_image_size('large');
    remove_image_size('medium_large');
    remove_image_size('1536x1536');
    remove_image_size('2048x2048');
}
add_action('init', 'disable_thumbnail_image_sizes');


/*
	Disable REST API links in HTML <head>
	<link rel='https://api.w.org/' href='https://example.com/wp-json/' />
*/
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');

function theme_remove_generator()  {
	return '';
}
add_filter( 'the_generator', 'theme_remove_generator' );


/*-- Disable Self Pingbacks --*/
function theme_disable_self_pingbacks( &$links ) {
  foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'theme_disable_self_pingbacks' );




/*-- Remove Feed Support --*/
function theme_remove_feed() {
   remove_theme_support( 'automatic-feed-links' );
}

add_action( 'after_theme_support', 'theme_remove_feed' );


/*-- Remove Comments --*/ 
function theme_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'theme_remove_admin_menus' );

add_filter('get_the_archive_title', function ($title) {
    // Видаляємо префікси за допомогою регулярного виразу
    return preg_replace('/^(Category:|Tag:|Author:|Year:|Month:)\s*/', '', $title);
});

function theme_remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'theme_remove_comment_support', 100);


function theme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
  }
add_action( 'wp_before_admin_bar_render', 'theme_admin_bar_render' );


function theme_get_attachment_image_no_srcset($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
   
    add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
   
    $html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);
   
    remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' );

    return $html;
}

function theme_disable_wp_basic_script($scripts) {
 
    if (!is_admin() && 
        isset($scripts->registered['jquery-migrate']) && 
        isset($scripts->registered['i18n']) && 
        isset($scripts->registered['wp-polyfill']) && 
        isset($scripts->registered['regenerator-runtime']) && 
        isset($scripts->registered['hooks']) &&
        isset($scripts->registered['jquery-blockui'])
    ) {
      
        unset($scripts->registered['jquery-migrate']);
        unset($scripts->registered['i18n']);
        unset($scripts->registered['wp-polyfill']);
        unset($scripts->registered['regenerator-runtime']);
        unset($scripts->registered['hooks']);
        unset($scripts->registered['jquery-blockui']);
        
    }
}
add_action( 'wp_default_scripts', 'theme_disable_wp_basic_script' );



function theme_remove_default_image_sizes( $sizes) {
	unset( $sizes['1536x1536']);
	unset( $sizes['2048x2048']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'theme_remove_default_image_sizes');


function theme_admin_hide_contacts( $contactmethods ) {
	unset($contactmethods['linkedin']);
	unset($contactmethods['myspace']);
	unset($contactmethods['pinterest']);
	unset($contactmethods['soundcloud']);
	unset($contactmethods['twitter']);
	unset($contactmethods['tumblr']);
	unset($contactmethods['wikipedia']);
	unset($contactmethods['facebook']);
	unset($contactmethods['youtube']);
	unset($contactmethods['instagram']);
	unset($contactmethods['twitter']);
	return $contactmethods;
}
add_filter('user_contactmethods', 'theme_admin_hide_contacts', 10, 1);


function change_text_tab_label() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.wp-switch-editor.switch-html').text('HTML');
    });
    </script>
    <?php
}
add_action('admin_footer', 'change_text_tab_label');

