<?php 
get_header();
/* Template Name: Шаблон з сайдбаром */ 
?>
<div class="main">
    <div class="page__wrapper container">
        <div class="page__head">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb();
            } ?>
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="article">
            <div class="article__wrapper">
                <div class="article__inner">
                    <div class="article__content h-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="article__sidebar">
                        <?php theme_sidebar() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();