<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function theme_setup() {

	load_theme_textdomain( THEME, get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );

    add_theme_support('post-thumbnails', ['post', 'page']);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

}
add_action( 'after_setup_theme', 'theme_setup' );


function theme_add_image_column($columns) {

    $new_columns = array(
        'post_image' => 'Image',
    );

    $columns = array_slice($columns, 0, 1, true) + $new_columns + array_slice($columns, 1, null, true);

    return $columns;
}
add_filter('manage_posts_columns', 'theme_add_image_column');
add_filter('manage_pages_columns', 'theme_add_image_column'); // Для сторінок

function allow_editor_access_appearance() {
    $role = get_role('editor');
    if ($role) {
        $role->add_cap('edit_theme_options'); // Додає можливість редагувати налаштування теми
    }
}
add_action('init', 'allow_editor_access_appearance');

// Рендеримо зображення в колонці
function theme_image_column_render($column_name, $post_id) {
    if ($column_name === 'post_image') {
        $post_thumbnail_id = get_post_thumbnail_id($post_id);

        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
            echo '<img src="' . esc_url($post_thumbnail_img[0]) . '" alt="thumbnail" />';
        } 
    }
}

// Додаємо колонку для всіх користувацьких типів постів
function theme_register_all_custom_post_types() {
    $post_types = get_post_types(array(), 'objects');
    foreach ($post_types as $post_type) {
        if ($post_type->name !== 'attachment' && $post_type->name !== 'revision') {
            // Додаємо колонку лише один раз
            add_filter("manage_{$post_type->name}_posts_columns", 'theme_add_image_column');
            // Рендеримо колонку зображень
            add_action("manage_{$post_type->name}_posts_custom_column", 'theme_image_column_render', 10, 2);
        }
    }
}
add_action('init', 'theme_register_all_custom_post_types');


function theme_customizer_setup() {
    add_theme_support('site-icon');
}
add_action('after_setup_theme', 'theme_customizer_setup');

function theme_include_svg_ico($mime_types) {
    $mime_types['ico'] = 'image/x-icon';
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'theme_include_svg_ico');



function theme_svg_security_headers($headers) {
    $headers['Content-Type'] = 'image/svg+xml';
    return $headers;
}
add_filter('wp_get_attachment_image_attributes', 'theme_svg_security_headers');


add_filter( 'wpcf7_ajax_loader', '__return_false' );



