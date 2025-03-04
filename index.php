<?php 
    get_header();
?>

<div class="main">
    <div class="page__wrapper container">
        <div class="page__head">
            <?php 
                theme_breadcrumbs();
            ?>
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="page__content h-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer();