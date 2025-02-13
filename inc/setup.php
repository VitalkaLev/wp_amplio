<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function theme_setup() {

	load_theme_textdomain( THEME, get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'header-menu' => esc_html__( 'Header', THEME ),
			'footer-col-1' => esc_html__( 'Footer column 1', THEME ),
			'footer-col-2' => esc_html__( 'Footer column 2', THEME ),
			'footer-col-3' => esc_html__( 'Footer column 3', THEME ),
			'footer-col-4' => esc_html__( 'Footer column 4', THEME ),
			'footer-col-5' => esc_html__( 'Footer column 5', THEME ),
			'footer-col-6' => esc_html__( 'Footer column 6', THEME ),
		)
	);

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



function theme_projects_taxonomy_filter() {
    global $typenow;
    $post_type = 'project'; 

    if ($typenow == $post_type) {

		$taxonomy_slug = 'dt_portfolio_category'; 
        
		$terms = get_terms(array(
            'taxonomy' => $taxonomy_slug,
            'hide_empty' => false, 
        ));

        if ($terms && !is_wp_error($terms)) {
            $taxonomy = get_taxonomy($taxonomy_slug);
            
            if ($taxonomy && $taxonomy->public) {
                $selected = isset($_GET[$taxonomy_slug]) ? $_GET[$taxonomy_slug] : '';
                wp_dropdown_categories(array(
                    'show_option_all' => __("All {$taxonomy->label}"),
                    'taxonomy' => $taxonomy_slug,
                    'name' => $taxonomy_slug,
                    'orderby' => 'name',
                    'selected' => $selected,
                    'show_count' => true,
                    'hide_empty' => false,
					'value_field' => 'slug'
                ));
            }
        }
    }
}

add_action('restrict_manage_posts', 'theme_projects_taxonomy_filter');


function theme_custom_class_to_nav_links($atts, $item, $args, $depth) {

    if ($depth === 0) {

        $atts['class'] = 'header__nav-link';

    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'theme_custom_class_to_nav_links', 10, 4);


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


function add_category_to_body_class($classes) {
    global $post;
    $taxonomies = ['dt_portfolio_category', 'product_cat']; 

    if (is_single()) {
      
        foreach ($taxonomies as $taxonomy) {
            $terms = wp_get_post_terms($post->ID, $taxonomy);

            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    // Add the term slug to the body class array
                    $classes[] = $taxonomy . '-' . $term->slug;
                }
            }
        }
         return $classes;
    }
    if (is_archive()) {
        if (is_category()) {
            $category = get_queried_object();
            if ($category) {
                $classes[] = 'category-' . $category->slug;
            }
        }
    }

    return $classes;
}

add_filter('body_class', 'add_category_to_body_class');
