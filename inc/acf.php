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


function register_acf_blocks_page() {
    $blocks = [
        'hero' => 'Блок - Перший екран',
        'why' => ' Блок - Чому обирають нас',
        'documents' => 'Блок - Усе, що треба',
		'credit' => 'Блок - Калькулятор кредиту',
        'steps' => 'Блок - Отримайте кредит за 3 кроки',
		'help' => 'Блок - Прості способи погашення кредиту',
		'faq' => 'Блок - Відповідаємо на часті запитання',
        'blog' => 'Блок - Блог'
    ];

    $icon = '<svg width="40" height="256" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="256" height="256" rx="64" fill="#3F2EE8"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M144.93 54C128.133 54 112.94 63.9703 106.258 79.3778L80.4431 138.899C76.2272 136.775 72.2707 134.419 68.5793 131.975C62.2038 127.753 56.7391 123.347 52.1229 119.489C51.4096 118.893 50.6765 118.274 49.934 117.647C46.4504 114.704 42.7609 111.587 39.9502 109.881L28 129.561C29.1328 130.249 30.9184 131.749 34.2273 134.53C35.1466 135.303 36.1835 136.175 37.3566 137.155C42.1961 141.199 48.4262 146.244 55.8647 151.17C60.4925 154.234 65.6349 157.284 71.27 160.05L52.7883 202.663H78.6035L93.5181 168.274C100.412 170.003 107.789 171.102 115.624 171.29C133.83 171.724 149.595 168.138 163.396 162.172V202.542H187.081V148.601C203.72 136.624 216.884 121.826 228 109.137L210.678 93.9675C203.202 102.502 195.489 111.091 187.081 118.841V96.1451C187.081 72.869 168.209 54 144.93 54ZM116.174 148.273C111.552 148.163 107.106 147.637 102.84 146.781L127.987 88.7992C130.915 82.049 137.571 77.6809 144.93 77.6809C155.129 77.6809 163.396 85.9476 163.396 96.1451V136.491C150.005 144.061 134.636 148.714 116.174 148.273Z" fill="white"/>
</svg>
    ';


    foreach ($blocks as $block_name => $block_title) {
        acf_register_block_type([
            'post_types'        => ['page'],
            'name'              => $block_name,
            'title'             => __($block_title, THEME),
            'description'       => '',
            'render_template'   => PATH . "/blocks/{$block_name}/block.php",
            'category'          => 'basic',
            'icon'              => $icon,
            'keywords'          => [$block_name, 'acf', 'custom'],
            'mode'              => 'preview',
            'example' => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        "preview_image_help" => PATH_URL . "/blocks/{$block_name}/preview.png",
                    ],
                ]
            ],
            'supports'          => ['mode' => true]
        ]);
    }
}
add_action('acf/init', 'register_acf_blocks_page');



function register_acf_blocks_widget() {
    $blocks = [
		'credit' => 'Блок - Калькулятор кредиту міні',
    ];

    $icon = '<svg width="40" height="256" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="256" height="256" rx="64" fill="#3F2EE8"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M144.93 54C128.133 54 112.94 63.9703 106.258 79.3778L80.4431 138.899C76.2272 136.775 72.2707 134.419 68.5793 131.975C62.2038 127.753 56.7391 123.347 52.1229 119.489C51.4096 118.893 50.6765 118.274 49.934 117.647C46.4504 114.704 42.7609 111.587 39.9502 109.881L28 129.561C29.1328 130.249 30.9184 131.749 34.2273 134.53C35.1466 135.303 36.1835 136.175 37.3566 137.155C42.1961 141.199 48.4262 146.244 55.8647 151.17C60.4925 154.234 65.6349 157.284 71.27 160.05L52.7883 202.663H78.6035L93.5181 168.274C100.412 170.003 107.789 171.102 115.624 171.29C133.83 171.724 149.595 168.138 163.396 162.172V202.542H187.081V148.601C203.72 136.624 216.884 121.826 228 109.137L210.678 93.9675C203.202 102.502 195.489 111.091 187.081 118.841V96.1451C187.081 72.869 168.209 54 144.93 54ZM116.174 148.273C111.552 148.163 107.106 147.637 102.84 146.781L127.987 88.7992C130.915 82.049 137.571 77.6809 144.93 77.6809C155.129 77.6809 163.396 85.9476 163.396 96.1451V136.491C150.005 144.061 134.636 148.714 116.174 148.273Z" fill="white"/>
</svg>
    ';


    foreach ($blocks as $block_name => $block_title) {
        acf_register_block_type([
            'post_types'        => ['widget'],
            'name'              => $block_name.'_mini',
            'title'             => __($block_title, THEME),
            'description'       => '',
            'render_template'   => PATH . "/blocks/{$block_name}/templates/mini.php",
            'category'          => 'basic',
            'icon'              => $icon,
            'keywords'          => [$block_name, 'acf', 'custom'],
            'mode'              => 'preview',
            'example' => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        "preview_image_help" => PATH_URL . "/blocks/{$block_name}/mini.png",
                    ],
                ]
            ],
            'supports'          => ['mode' => true]
        ]);
    }
}
add_action('acf/init', 'register_acf_blocks_widget');


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




function theme_preview_image($is_preview,$block){ 
    if( !empty($block['example']['attributes']['data']['image']) ){
        echo $block['example']['attributes']['data']['image'];
    }
}