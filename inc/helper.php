<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter('wpcf7_autop_or_not', '__return_false');


function dd($data){
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

function theme_text($data) {
    if (isset($data) && !empty($data) && is_string($data)) {
        $allowed_tags = array_merge(
            wp_kses_allowed_html('post'),
            [
                'iframe' => [
                    'src'             => [],
                    'width'           => [],
                    'height'          => [],
                    'allowfullscreen' => []
                ]
            ]
        );

        return wp_kses($data, $allowed_tags);
    }
    return '';
}

function theme_home_url(){
    echo esc_url( get_home_url() ); 
}


function theme_image($id, $widthSize, $heightSize , $class_name = ''){

    $image_html = '';
    if (!empty($id)) {
        $image_html = wp_get_attachment_image( $id, [$widthSize, $heightSize], false, ['loading' => 'lazy'] );
        echo wp_kses_post( $image_html );
    } 

}


function theme_image_post_url($id, $widthSize, $heightSize){

    if ( !empty($id) ) {
        return esc_url(wp_get_attachment_image_url( get_post_thumbnail_id($id), [$widthSize, $heightSize] ));
    }

}


function theme_image_url($id, $widthSize, $heightSize){

    if ( !empty($id) ) {
        return esc_url(wp_get_attachment_image_url( $id, [$widthSize, $heightSize] ));
    } else {
        return esc_url(wc_placeholder_img_src());
    }

}

function theme_title_filter($title, $id) {
    if( !is_single() ){
        $max_length = 69;
        if (mb_strlen($title) > $max_length) {
            $title = mb_substr($title, 0, $max_length) . '...';
        } 
    }
    return $title;
}

add_filter('the_title', 'theme_title_filter', 10, 2);