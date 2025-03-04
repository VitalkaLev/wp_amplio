<?php 
    get_header();

    $post_id = get_the_ID();
    $category = get_the_category($post_id); 
    $share = theme_post_share($post_id);
    $category_id = isset($category) ? $category[1]->term_id : '';
    $category_name = isset($category) ? $category[1]->name : '';
    $category_slug = get_category_link($category_id);

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -12,
        'orderby' => 'date',
        'order' => 'DESC',
        'cat' => $category_id,
        'post__not_in' => array($post_id),
    );

    $query = new WP_Query($args);
    $count = $query->post_count;
    $recently = $query->posts;
?>

<div class="main">
    <div class="article">
        <div class="article__wrapper container">
            <div class="article__head">
                <a href="<?php echo theme_home_url().'/blog'; ?>" class="article__back">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99967 12.6668L3.33301 8.00016M3.33301 8.00016L7.99967 3.3335M3.33301 8.00016H12.6663" stroke="#2046D2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php _e('Назад', THEME); ?>
                </a>
                <?php 
                    theme_breadcrumbs();
                ?>
                <?php if (!has_post_thumbnail()) { ?>
                    <h1><?php the_title(); ?></h1>
                <?php } ?>
            </div>
            <div class="article__inner">
                <div class="article__content h-content">
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="article__image h-opacity" style="background-image:url(<?php the_post_thumbnail_url('large'); ?>)">
                            <div class="article__image__content">
                                <h1><?php the_title(); ?></h1>
                                <div class="article__group">
                                    <a href="<?php echo esc_url($category_slug); ?>" class="article__category">
                                        <?php echo $category_name; ?>
                                    </a>
                                    <span class="article__date">
                                        <?php echo get_the_date('d F Y', $post_id); ?>
                                    </span>
                                    <?php theme_post_view($post_id,'white'); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="h-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="article__group article__group-bottom">
                        <div class="article__part">
                            <span class="article__date">
                                <?php echo get_the_date('d F Y', $post_id); ?>
                            </span>
                            <?php theme_post_view($post_id,'black'); ?>
                        </div>
                        <div class="article__share">
                            <span>
                                Поділитися:
                            </span>
                            <a class="article__share__item" href="<?php echo esc_url($share['facebook']); ?>" target="_blank" rel="noopener noreferrer">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="16" cy="16" r="16" fill="#2046D2"/>
                                    <path d="M14.4639 16.8317C14.4159 16.8317 13.3599 16.8317 12.8799 16.8317C12.6239 16.8317 12.5439 16.7357 12.5439 16.4957C12.5439 15.8557 12.5439 15.1997 12.5439 14.5597C12.5439 14.3037 12.6399 14.2237 12.8799 14.2237H14.4639C14.4639 14.1757 14.4639 13.2477 14.4639 12.8157C14.4639 12.1757 14.5759 11.5677 14.8959 11.0077C15.2319 10.4317 15.7119 10.0477 16.3199 9.82372C16.7199 9.67972 17.1199 9.61572 17.5519 9.61572H19.1199C19.3439 9.61572 19.4399 9.71172 19.4399 9.93572V11.7597C19.4399 11.9837 19.3439 12.0797 19.1199 12.0797C18.6879 12.0797 18.2559 12.0797 17.8239 12.0957C17.3919 12.0957 17.1679 12.3037 17.1679 12.7517C17.1519 13.2317 17.1679 13.6957 17.1679 14.1917H19.0239C19.2799 14.1917 19.3759 14.2877 19.3759 14.5437V16.4797C19.3759 16.7357 19.2959 16.8157 19.0239 16.8157C18.4479 16.8157 17.2159 16.8157 17.1679 16.8157V22.0317C17.1679 22.3037 17.0879 22.3997 16.7999 22.3997C16.1279 22.3997 15.4719 22.3997 14.7999 22.3997C14.5599 22.3997 14.4639 22.3037 14.4639 22.0637C14.4639 20.3837 14.4639 16.8797 14.4639 16.8317Z" fill="white"/>
                                </svg>
                            </a>
                            <a class="article__share__item" href="<?php echo esc_url($share['twitter']); ?>" target="_blank" rel="noopener noreferrer">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="16" cy="16" r="16" fill="#2046D2"/>
                                    <path d="M19.9932 9.3335H22.1985L17.3805 14.8402L23.0485 22.3335H18.6105L15.1345 17.7888L11.1572 22.3335H8.9505L14.1038 16.4435L8.6665 9.3335H13.2172L16.3592 13.4875L19.9932 9.3335ZM19.2192 21.0135H20.4412L12.5532 10.5842H11.2418L19.2192 21.0135Z" fill="white"/>
                                </svg>
                            </a>
                            <a class="article__share__item" href="<?php echo esc_url($share['whatsapp']); ?>" target="_blank" rel="noopener noreferrer">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="16" cy="16" r="16" fill="#2046D2"/>
                                    <path d="M17.3686 9.15771H14.6318C11.9791 9.15771 9.84229 11.2946 9.84229 13.9472V15.9998C9.84229 17.8525 10.9054 19.5367 12.5791 20.3261V22.6209C12.5791 22.7367 12.6844 22.8419 12.8212 22.8419C12.8739 22.8419 12.937 22.8209 12.9791 22.7788L14.9581 20.7893H17.3686C20.0212 20.7893 22.1581 18.6525 22.1581 15.9998V13.9472C22.1581 11.2946 20.0212 9.15771 17.3686 9.15771ZM19.1686 18.1367L18.4844 18.8209C17.7475 19.5367 15.8528 18.7156 14.1791 17.0103C12.5054 15.3051 11.7581 13.3788 12.4633 12.663L13.1475 11.9788C13.4212 11.7261 13.8528 11.7367 14.1265 11.9998L15.116 13.0314C15.3686 13.3051 15.3686 13.7156 15.0949 13.9893C15.0212 14.063 14.937 14.1051 14.8423 14.1472C14.4949 14.2525 14.316 14.5893 14.4002 14.9367C14.5686 15.6946 15.5265 16.6419 16.2528 16.8314C16.5897 16.9156 16.937 16.7261 17.0528 16.3998C17.1686 16.063 17.5475 15.8735 17.9054 15.9893C18.0107 16.0209 18.0949 16.0946 18.1791 16.1577L19.1686 17.1893C19.4212 17.4419 19.4212 17.863 19.1686 18.1367ZM16.6107 12.4103C16.537 12.4103 16.4739 12.4103 16.4107 12.4314C16.2949 12.4525 16.1686 12.3577 16.1581 12.2209C16.1475 12.084 16.2318 11.9788 16.3581 11.9682C16.4423 11.9472 16.5265 11.9472 16.6107 11.9472C17.8739 11.9472 18.8844 12.9788 18.9054 14.2209C18.9054 14.3051 18.9054 14.3893 18.8844 14.4735C18.8633 14.5893 18.7686 14.6946 18.6318 14.6735C18.4949 14.6525 18.4107 14.5577 18.4318 14.4209C18.4318 14.3472 18.4528 14.284 18.4528 14.2209C18.4423 13.2314 17.6212 12.4103 16.6107 12.4103ZM17.9791 14.2419C17.9581 14.3577 17.8633 14.463 17.7265 14.4419C17.6212 14.4209 17.5265 14.3367 17.5265 14.2419C17.5265 13.7472 17.116 13.3367 16.6212 13.3367C16.5054 13.3577 16.3791 13.2525 16.3686 13.1261C16.3475 13.0103 16.4528 12.884 16.5686 12.8735H16.6002C17.3897 12.8735 17.9791 13.484 17.9791 14.2419ZM19.7265 14.9682C19.7054 15.084 19.5897 15.1682 19.4739 15.1577C19.3581 15.1472 19.2739 15.0209 19.2844 14.9051C19.2844 14.884 19.2844 14.884 19.2844 14.8735C19.337 14.6735 19.3581 14.463 19.3581 14.2419C19.3581 12.7367 18.1265 11.5051 16.6212 11.5051C16.5475 11.5051 16.4844 11.5051 16.4212 11.5051C16.3054 11.5261 16.1791 11.4209 16.1791 11.2946C16.1581 11.1788 16.2633 11.0525 16.3791 11.0525C16.4633 11.0525 16.5475 11.0314 16.6212 11.0314C18.3791 11.0314 19.8212 12.463 19.8212 14.2314C19.8107 14.4735 19.7791 14.7367 19.7265 14.9682Z" fill="white"/>
                                </svg>
                            </a>
                            <a class="article__share__item" href="<?php echo esc_url($share['telegram']); ?>" target="_blank" rel="noopener noreferrer">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="16" cy="16" r="16" fill="#2046D2"/>
                                    <path d="M9.30871 15.9158L12.5289 17.0094L20.1741 12.3355C20.2849 12.2678 20.3985 12.4183 20.3029 12.5063L14.5149 17.8338L14.2997 20.8164C14.2833 21.0433 14.5566 21.1696 14.7188 21.0101L16.5009 19.2577L19.7588 21.7239C20.1099 21.9898 20.6184 21.8024 20.7131 21.3723L22.9816 11.0723C23.111 10.4847 22.5352 9.98889 21.9734 10.2041L9.29233 15.06C8.89453 15.2123 8.90536 15.7788 9.30871 15.9158Z" fill="white"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="article__sidebar">
                    <?php theme_sidebar() ; ?>
                </div>
            </div>
            <div class="article__recently">
                <h2>
                    <?php _e("Інші статті",THEME); ?>
                </h2>
                <?php if( !empty($recently) ){ ?>
                    <div class="article__slider">
                        <div class="article__buttons">
                            <button class="prev">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="24" cy="24" r="24" stroke="#98E48A"/>
                                    <path d="M24 29.8333L18.1666 24M18.1666 24L24 18.1666M18.1666 24H29.8333" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button class="next active">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="24" cy="24" r="24" stroke="#98E48A"/>
                                    <path d="M24 29.8333L29.8334 24M29.8334 24L24 18.1666M29.8334 24H18.1667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="swiper-wrapper article__slider__wrapper">
                            <?php foreach ($recently as $item) { 
                                $post = $item->ID;
                                $image_id = get_post_thumbnail_id($post);
                                $recently_category = get_the_category($post); 
                                $recently_category_name = isset($recently_category) ? $recently_category[1]->name : '';
                                ?> 
                                <a href="<?php echo esc_url( get_the_permalink($post) ); ?>" class="swiper-slide post article__item">
                                    <div class="post__image h-opacity">
                                        <?php echo theme_image($image_id,'260','180'); ?>
                                        <span class="post__category post__category--label">
                                            <?php echo theme_text($recently_category_name); ?>
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
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div> 
        </div>
    </div>
</div>

<?php get_footer();