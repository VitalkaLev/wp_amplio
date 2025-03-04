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


// Функція для отримання кількості переглядів
function get_post_views($post_id) {
    $count = get_post_meta($post_id, 'post_views_count', true);
    return (is_numeric($count)) ? $count : 0;
}

// Функція для виведення переглядів поста
function theme_post_view($post_id, $style) {
    $count = get_post_views($post_id);

    // Встановлення стилю кольору
    $color = ($style == 'white') ? 'white' : '#AAAAAA';

    // Вивід HTML-коду
    echo "<div class='post__view'>";
        echo '<svg width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.603 11.5548C18.0111 11.5548 23.206 9.06775 23.206 5.99981C23.206 2.93188 18.0111 0.444824 11.603 0.444824C5.19483 0 0 2.93188 0 5.99981C0 9.06775 5.19483 11.5548 11.603 11.5548ZM11.603 8.87357C13.1901 8.87357 14.4767 7.58695 14.4767 5.99983C14.4767 4.41271 13.1901 3.1261 11.603 3.1261C10.0159 3.1261 8.72925 4.41271 8.72925 5.99983C8.72925 7.58695 10.0159 8.87357 11.603 8.87357Z" fill="'.$color.'"/>
        </svg>';
        echo "<span class='post__counter'>{$count}</span>";
    echo "</div>";
}

// Функція для встановлення перегляду, якщо користувач ще не переглядав пост
function set_post_views($post_id) {
    if (!is_numeric($post_id)) return;

    $count_key = 'post_views_count';
    $count = get_post_views($post_id); // Отримуємо поточний лічильник

    // Використання COOKIE для перевірки унікального перегляду
    $cookie_name = "viewed_post_" . $post_id;
    if (isset($_COOKIE[$cookie_name])) {
        return; // Користувач вже переглядав цей пост
    }

    // Використання SESSION (альтернативний метод)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['viewed_posts']) && in_array($post_id, $_SESSION['viewed_posts'])) {
        return; // Користувач вже переглядав цей пост у цій сесії
    }

    // Додаємо пост в список переглянутих
    $_SESSION['viewed_posts'][] = $post_id;
    setcookie($cookie_name, '1', time() + 86400, "/"); // 1 день

    // Збільшуємо лічильник переглядів
    $count++;
    update_post_meta($post_id, $count_key, $count);

    // Видалення кешу
    wp_cache_delete($post_id, 'post_meta');
}

// Функція для відстеження переглядів постів
function track_post_views() {
    if (!is_single()) return; // Виконується лише на сторінці одного поста
    if (is_admin()) return; // Не працює в адмін-панелі

    global $post;
    if (!$post) return; // Перевірка наявності поста

    set_post_views($post->ID);
}

// Додаємо функцію відстеження переглядів до хуку `wp`
add_action('wp', 'track_post_views');


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

function theme_breadcrumbs() {

	/* === ОПЦИИ === */
	$text['home']     = 'Amplio'; // текст ссылки "Главная"
	$text['category'] = '%s'; // текст для страницы рубрики
	$text['search']   = 'Result search by "%s"'; // текст для страницы с результатами поиска
	$text['tag']      = '%s'; // текст для страницы тега
	$text['author']   = 'Post author %s'; // текст для страницы автора
	$text['404']      = 'Error 404'; // текст для страницы 404
	$text['page']     = 'Page %s'; // текст 'Страница N'
	$text['cpage']    = 'Page comments %s'; // текст 'Страница комментариев N'

	$wrap_before    = '<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
	$wrap_after     = '</ul>'; // закрывающий тег обертки
	$sep            = ''; // разделитель между "крошками"

	$before         = '<li class="breadcrumb__item"><span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
	$after          = '</span></li>'; // тег после текущей "крошки"

	$show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	$show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	$show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
	$show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
	/* === КОНЕЦ ОПЦИЙ === */

	global $post;
	$home_url       = home_url('/');
	$link           = '<li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link          .= '<a class="breadcrumb__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 9.5L5 5.5L1 1.5" stroke="#5E5E5E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>';
	$link          .= '<meta itemprop="position" content="%3$s" />';
	$link          .= '</li>';
	$parent_id      = ( $post ) ? $post->post_parent : '';
	$home_link      = sprintf( $link, $home_url, $text['home'], 1 );

	if ( is_home() || is_front_page() ) {

		if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

	} else {

		$position = 0;

		echo $wrap_before;

		if ( $show_home_link ) {
			$position += 1;
			echo $home_link;
		}

		if ( is_category() ) {
			$parents = get_ancestors( get_query_var('cat'), 'category' );
			foreach ( array_reverse( $parents ) as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$cat = get_query_var('cat');
				echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo '<li><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 9.5L5 5.5L1 1.5" stroke="#5E5E5E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg></li>';
					echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_search() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $show_home_link ) echo $sep;
				echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['search'], get_search_query() ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_year() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_time('Y') . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_month() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_day() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
			$position += 1;
			echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$position += 1;
				$post_type = get_post_type_object( get_post_type() );
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
				if ( $show_current ) echo $sep . $before . get_the_title() . $after;
				elseif ( $show_last_sep ) echo $sep;
			} else {
				$cat = get_the_category(); $catID = $cat[0]->cat_ID;
				$parents = get_ancestors( $catID, 'category' );
				$parents = array_reverse( $parents );
				$parents[] = $catID;
				foreach ( $parents as $cat ) {
					$position += 1;
					if ( $position > 1 ) echo $sep;
					echo '<li><a href=" '. get_home_url().'/blog"><span>Блог</span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 9.5L5 5.5L1 1.5" stroke="#5E5E5E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg></a></li>';
				}
				if ( get_query_var( 'cpage' ) ) {
					$position += 1;
					echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
					echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
				} else {
					if ( $show_current ) echo $sep . $before . get_the_title() . $after;
					elseif ( $show_last_sep ) echo $sep;
				}
			}

		} elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . $post_type->label . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_attachment() ) {
			$parent = get_post( $parent_id );
			$cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
			$parents = get_ancestors( $catID, 'category' );
			$parents = array_reverse( $parents );
			$parents[] = $catID;
			foreach ( $parents as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			$position += 1;
			echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_page() && ! $parent_id ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_title() . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_page() && $parent_id ) {
			$parents = get_post_ancestors( get_the_ID() );
			foreach ( array_reverse( $parents ) as $pageID ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
			}
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_tag() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$tagID = get_query_var( 'tag_id' );
				echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				echo '<li><a href=" '. HOME.'/blog">Блог</a><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 9.5L5 5.5L1 1.5" stroke="#5E5E5E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg></li>';
				if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_author() ) {
			$author = get_userdata( get_query_var( 'author' ) );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_404() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . $text['404'] . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( has_post_format() && ! is_singular() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			echo get_post_format_string( get_post_format() );
		}

		echo $wrap_after;

	}
} 