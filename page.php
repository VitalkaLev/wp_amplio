<?php 
    get_header();
?>

<div class="main">
    <div class="page__wrapper container">
        <h1>
            <?php the_title(); ?>
        </h1>
        <div class="page__content h-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer();