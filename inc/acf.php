<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function theme_allowed_blocks( $allowed_blocks ) {
	$allowed_blocks = array(
		'core/heading',
		'core/paragraph',
		'core/columns',
		'core/html',
		'core/image',
        'core/list',
		'core/list-item',
		'core/separator',
		'core/spacer',
		'core/table',
		'core/embed',
		'core/file',
		'core/video',
		'core/shortcode'
	);

	$acf_blocks = acf_get_block_types();

	foreach ( array_keys( $acf_blocks ) as $block_name ) :
		$allowed_blocks[] = $block_name;
	endforeach;

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'theme_allowed_blocks' );


function register_acf_blocks() {
    $blocks = [
        'hero' => 'Hero Block',
        'why' => ' Block',
        'documents' => 'Documents Block',
		'credit' => 'Credit Block',
        'steps' => 'Steps Block',
		'help' => 'Steps Block',
		'faq' => 'Faq Block'
    ];

    foreach ($blocks as $block_name => $block_title) {
        acf_register_block_type([
            'name'              => $block_name,
            'title'             => __($block_title, THEME),
            'description'       => __('Custom ' . $block_title . ' with ACF fields', THEME),
            'render_template'   => get_template_directory() . "/blocks/{$block_name}/block.php",
            'category'          => 'formatting',
            'icon'              => 'admin-generic',
            'keywords'          => [$block_name, 'acf', 'custom'],
            'mode'              => 'edit',
            'supports'          => [
                'align'         => true,
                'anchor'        => true,
                'mode'          => false,
            ],
            'enqueue_assets' => function() use ($block_name) {
                $css_path = get_template_directory_uri() . "/template-parts/blocks/{$block_name}/{$block_name}.css";
                if (file_exists(get_template_directory() . "/template-parts/blocks/{$block_name}/{$block_name}.css")) {
                    wp_enqueue_style("{$block_name}-block-css", $css_path);
                }
            },
        ]);
    }
}
add_action('acf/init', 'register_acf_blocks');



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


function add_default_value_to_image_field($field) {
    acf_render_field_setting( $field, array(
      'label'      => __('Default Image','acf'),
      'instructions'  => __('Appears when creating a new post','acf'),
      'type'      => 'image',
      'name'      => 'default_value',
    ));
}
add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field', 20);
