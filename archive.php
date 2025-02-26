<?php 
    get_header();
?>

<div class="main">
    <div class="page__wrapper container">
        <div class="page__head">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb();
            } ?>
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="page__archive">
            <?php if ( have_posts()) { ?>
                <div class="posts posts--archive">
                    <?php while (have_posts()) : the_post();
                        $post = get_the_ID();
                        ?> 
                        <a href="<?php the_permalink(); ?>" id="<?php esc_attr_e($post); ?>"  class="posts__item posts__item--highlighted">
                            <span class="posts__image h-opacity">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" loading='lazy'>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/src/images/placeholder.png" alt="Placeholder">
                                <?php endif; ?>
                            </span>
                            <div class="posts__box">
                                <h4 class="posts__title">
                                    <?php the_title(); ?>
                                </h4>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php } ?>
            <div class="sidebar"></div>
        </div>
    </div>
</div>

<?php get_footer();