<?php

$count = get_field('acf_posts_counter');
$categories = get_field('acf_categories');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type' => 'post',
    'posts_per_page' => $count,
    'orderby' => 'date',
    'order'   => 'DESC',
    'paged' => $paged
];

$query = new WP_Query($args);

$posts = $query->posts;

if( isset( $block['data']['preview_image_help'] )) {
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else { ?>
    <section class="blog">
        <div class="blog__inner">
            <?php if ( !empty($posts)) { ?>
                <div class="blog__content">
                    <?php if( !empty($categories) ){ ?>
                        <div class="blog__categories">
                            <?php 
                        
                            foreach ($categories as $index => $category) { 
                                
                                if($index == 0){ ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-link current">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-link">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php }
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <div class="blog__items">
                        <?php foreach ($posts as $post) {
                            $post_id = $post->ID;
                            $image_id = get_post_thumbnail_id($post);
                            $category = get_the_category($post); 
                            $category_name = isset($category) ? $category[1]->name : '';
                            ?> 
                            <a href="<?php echo esc_url( get_the_permalink($post) ); ?>" class="post blog__item">
                                <div class="post__image h-opacity">
                                    <?php echo theme_image($image_id,'260','180'); ?>
                                    <span class="post__category post__category--label">
                                        <?php echo theme_text($category_name); ?>
                                    </span>
                                </div>
                                <div class="post__box">
                                    <span class="post__title">
                                        <?php echo theme_text(get_the_title($post)); ?>
                                    </span>
                                    <div class="post__group">
                                        <span class="post__date">
                                            <?php echo get_the_date('d F Y', $post); ?>
                                        </span>
                                        <?php theme_post_view($post_id ,'black'); ?>
                                    </div>
                                </div>
                            </a>
                        <?php } wp_reset_postdata(); ?>
                    </div>
                    <div class="blog__bottom">
                        <?php theme_pagination($query); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="blog__sidebar">
                <?php theme_sidebar() ; ?>
            </div>
        </div>
    </section>
<?php } 