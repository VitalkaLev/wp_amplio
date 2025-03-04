<?php 
    get_header();
    global $wp_query;
    $categories = get_categories();
?>

<div class="main">
    <div class="page__wrapper container">
        <div class="page__head">
            <?php 
                theme_breadcrumbs();
            ?>
            <h1><?php the_archive_title(); ?></h1>
        </div>
       
        <div class="blog blog--archive">
            <div class="blog__inner">
                <?php if ( have_posts()) { ?>
                    <div class="blog__content">
                        <?php if( !empty($categories) ){ ?>
                            <div class="blog__categories">
                                <?php 
                            
                                foreach ($categories as $category) { ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-link<?php if (is_category($category->term_id)) echo ' current'; ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="blog__items">
                            <?php while (have_posts()) : the_post();
                                $post = get_the_ID();
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
                                            <?php theme_post_view($post ,'black'); ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <div class="blog__bottom">
                            <?php theme_pagination($wp_query); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="blog__sidebar">
                    <?php theme_sidebar() ; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();