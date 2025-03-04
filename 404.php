<?php 
    get_header();
?>

<div class="main">
    <div class="article">
        <div class="article__wrapper container">
            <div class="article__head">
                <a href="<?php echo theme_home_url(); ?>" class="article__back">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99967 12.6668L3.33301 8.00016M3.33301 8.00016L7.99967 3.3335M3.33301 8.00016H12.6663" stroke="#2046D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php _e('Назад', THEME); ?>
                </a>
                <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb();
                    } 
                ?>
            </div>
            <div class="page__content">
                <div class="article__404 h-center h-flex-column ">
                    <h1>
                        <?php _e('404'); ?>
                    </h1>
                    <p>
                        <?php _e('Сторінку не знайдено'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();