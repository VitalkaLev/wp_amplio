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


function get_share_links($post_id) {
    $post_url = get_permalink($post_id);
    $post_title = get_the_title($post_id);
    $post_thumbnail = get_the_post_thumbnail_url($post_id, 'full');

    return [
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?' . http_build_query([
            'u' => $post_url,
            'picture' => $post_thumbnail,
            'title' => $post_title,
            'description' => get_the_excerpt($post_id),
        ]),
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($post_title . ' ' . $post_url),
        'twitter' => 'https://twitter.com/intent/tweet?text=' . urlencode($post_title) . '&url=' . urlencode($post_url),
        'copy' => $post_url,
    ];
}


function get_primary_category($post_id){
    return get_post_meta($post_id, 'spc_primary_category', true);   
}

function get_related_posts($count , $post_id , $primary_category_id){
    $args = array(
        'post_type'      => 'post',        
        'posts_per_page' => $count,        
        'orderby'        => 'date',     
        'order'          => 'DESC', 
        'cat' => $primary_category_id, 
        'post__not_in' => array($post_id),     
    );
    
    return $query = new WP_Query($args);
}

function get_post_color($cat_id) {

    $args = array(
        'post_type'      => 'color',
        'cat'            => $cat_id,
        'posts_per_page' => 1,     
        'fields'         => 'ids'    
    );

    $color_ids = get_posts($args);

    if (!empty($color_ids)) {
        $color_id = $color_ids[0];
        $color = get_field('acf_post_color', $color_id);

        return !empty($color) ? esc_attr($color) : null;
    }

    return null;
}

function get_post_color_class($cat_id) {
    $args = array(
        'post_type'      => 'color',
        'cat'            => $cat_id,
        'posts_per_page' => 1,
        'fields'         => 'ids'
    );

    $color_ids = get_posts($args);

    if (!empty($color_ids)) {
        $color_id = $color_ids[0];
        $color_class = get_the_title($color_id);

        return !empty($color_class) ? esc_attr($color_class) : null;
    }

    return null;
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