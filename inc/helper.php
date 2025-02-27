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


function theme_post_view($post_id , $style){
    $count = get_post_meta($post_id, 'post_views_count', true);
    if ($count == '') {
        delete_post_meta($post_id, 'post_views_count');
        add_post_meta($post_id, 'post_views_count', '0');
        $count = '0';
    }
    if($style == 'white'){
        $style = 'white';
    } else {
        $style = '#AAAAAA';
    }
    echo "<div class='post__view'>";
        echo '<svg width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.603 11.5548C18.0111 11.5548 23.206 9.06775 23.206 5.99981C23.206 2.93188 18.0111 0.444824 11.603 0.444824C5.19483 0 0 2.93188 0 5.99981C0 9.06775 5.19483 11.5548 11.603 11.5548ZM11.603 8.87357C13.1901 8.87357 14.4767 7.58695 14.4767 5.99983C14.4767 4.41271 13.1901 3.1261 11.603 3.1261C10.0159 3.1261 8.72925 4.41271 8.72925 5.99983C8.72925 7.58695 10.0159 8.87357 11.603 8.87357Z" fill="'.$style.'"/>
        </svg>';
        echo "<span class='post__counter'>{$count}</span>";
    echo "</div>";
}

function set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    }else{
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}


function theme_post_share($post_id){
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
        'twitter' => 'https://twitter.com/intent/tweet?text=' . urlencode($post_title) . '&url=' . urlencode($post_url),
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($post_title . ' ' . $post_url),
        'telegram' => 'https://t.me/share/url?url=' . urlencode($post_url) . '&text=' . urlencode($post_title),
    ];
}


function theme_pagination($query){ 
    $current = max(1, get_query_var('paged'));
    $paginations = paginate_links(
        array(
            'prev_next'          => true,
            'prev_text' => 'Назад',
            'next_text' => 'Вперед',
            'type' => 'array',
            'mid_size' => 3,
            'total'   => isset( $query->max_num_pages ) ? $query->max_num_pages : 1,
            'current' => $current,

        )
    );

    if( $paginations ) {
        echo '<div class="pagination">';
        foreach ( $paginations as $pagination ) {
            $pagination_clean = str_replace( 'page-numbers', 'pagination-btn', $pagination );
            $pagination_clean = str_replace( 'current', 'active', $pagination_clean );
            echo $pagination_clean;
        }
        echo '</div>';
    }
   
}





function theme_sidebar(){
    $args = array(
        'post_type' => 'widget',
        'posts_per_page' => -1
    );

    $widget_posts = get_posts($args);

    if (!empty($widget_posts)) {
        foreach ($widget_posts as $post) {
            setup_postdata($post);
            the_content();
        }
        wp_reset_postdata();
    } 
}