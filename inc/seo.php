<?php
    
    add_filter('get_the_archive_title', function ($title) {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        }
        return $title;
    });
