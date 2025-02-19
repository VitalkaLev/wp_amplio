<?php
$title = get_field('acf_hero_title');
$label = get_field('acf_hero_label');
$button = get_field('acf_hero_button');
$button_text = isset($button['acf_hero_button_text']) ? $button['acf_hero_button_text'] : '';
$button_link = isset($button['acf_hero_button_link']) ? $button['acf_hero_button_link'] : '';
$button_icon = isset($button['acf_hero_button_icon']) ? $button['acf_hero_button_icon'] : '';
$slides = get_field('acf_hero_slides');
$bottom_sections = get_field('acf_hero_bottom_sections');
?>

<section id="hero" class="section hero animate-fade" data-delay="0.3s">
    <div class="hero__wrapper">
        <div class="hero__content">
            <?php if (!empty($title)) : ?>
                <h1 class="hero__title">
                    <?php echo theme_text($title); ?>
                    <?php if (!empty($label)) : ?>
                        <span class="hero__label">
                            <?php echo theme_text($label); ?>
                        </span>
                    <?php endif; ?>
                </h1>
            <?php endif; ?>
            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                <a href="<?php echo esc_url($button_link); ?>" class="btn btn-primary h-bg h-slide green">
                    <span><?php echo theme_text($button_text); ?></span>
                    <?php if($button_icon == false){ ?>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.48409 5.00008H11.1508M11.1508 11.6667V15.0001M11.1508 8.33341H11.1591M7.81742 8.33341H7.82576M4.48409 8.33341H4.49242M7.81742 11.6667H7.82576M4.48409 11.6667H4.49242M7.81742 15.0001H7.82576M4.48409 15.0001H4.49242M2.81742 1.66675H12.8174C13.7379 1.66675 14.4841 2.41294 14.4841 3.33341V16.6667C14.4841 17.5872 13.7379 18.3334 12.8174 18.3334H2.81742C1.89695 18.3334 1.15076 17.5872 1.15076 16.6667V3.33341C1.15076 2.41294 1.89695 1.66675 2.81742 1.66675Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    <?php } ?>
                </a>
            <?php endif; ?>
        </div>
        <?php if (!empty($slides)) : ?>
            <div class="hero__slider">
                <div class="hero__slider-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($slides as $slide) : ?>
                            <div class="swiper-slide hero__slide">
                                <div class="hero__slide__image">
                                    <?php theme_image($slide['image_id'], 500, 700, ''); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="hero__decor">
            <svg class="hero__decor-line hero__decor-line-desktop" width="1280" height="473" viewBox="0 0 1280 473" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M-236 365.351C194.411 527.794 1030.37 483.31 1421 -65" stroke="#2046D2" stroke-width="49"/>
            </svg>
            <svg class="hero__decor-line hero__decor-line-mobile" width="355" height="535" viewBox="0 0 355 535" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M-71 503C83 544.5 391 502 391 0" stroke="#2046D2" stroke-width="49"/>
            </svg>
            <svg class="hero__decor-bg" width="1280" height="680" viewBox="0 0 1280 680" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_481_195)">
                <rect width="1280" height="680" rx="48" fill="white"/>
                <rect width="1280" height="680" rx="48" fill="#2046D2" fill-opacity="0.05"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1212.14 55.1699C1141.05 55.1699 1076.74 97.0751 1048.46 161.833L939.192 412C921.347 403.071 904.601 393.171 888.976 382.897C861.99 365.153 838.86 346.633 819.32 330.42C816.301 327.915 813.198 325.312 810.055 322.676C795.31 310.308 779.694 297.21 767.796 290.038L717.215 372.752C722.01 375.642 729.567 381.95 743.573 393.639C747.464 396.886 751.853 400.549 756.819 404.669C777.303 421.666 803.673 442.87 835.158 463.573C854.746 476.454 876.513 489.274 900.365 500.896L822.137 680H931.405L994.535 535.464C1023.72 542.728 1054.94 547.351 1088.1 548.137C1165.16 549.963 1231.89 534.891 1290.31 509.816V679.492H1390.56V452.777C1460.99 402.439 1516.71 340.242 1563.76 286.909L1490.44 223.153C1458.8 259.023 1426.15 295.123 1390.56 327.695V232.306C1390.56 134.476 1310.68 55.1699 1212.14 55.1699ZM1090.43 451.399C1070.87 450.935 1052.05 448.724 1033.99 445.126L1140.43 201.431C1152.82 173.06 1181 154.7 1212.14 154.7C1255.31 154.7 1290.31 189.445 1290.31 232.306V401.88C1233.63 433.697 1168.58 453.251 1090.43 451.399Z" fill="white"/>
                <path d="M1421 -75C1030.37 473.31 194.411 517.794 -236 355.351V762H1421V-75Z" fill="url(#paint0_linear_481_195)" fill-opacity="0.3"/>
                </g>
                <defs>
                <linearGradient id="paint0_linear_481_195" x1="336.913" y1="131.791" x2="592.5" y2="693.5" gradientUnits="userSpaceOnUse">
                <stop offset="1" stop-color="white"/>
                </linearGradient>
                <clipPath id="clip0_481_195">
                <rect width="1280" height="680" rx="48" fill="white"/>
                </clipPath>
                </defs>
            </svg>
        </div>
        <?php if (!empty($bottom_sections)) : ?>
            <div class="hero__bottom animate-fade">
                <div class="hero__bottom__wrapper">
                    <?php foreach ($bottom_sections as $section) : ?>
                        <div class="hero__bottom-group">
                            <div class="hero__bottom__line"></div>
                            <span class="hero__bottom__subtitle"><?php echo theme_text($section['subtitle']); ?></span>
                            <span class="hero__bottom__title"><?php echo theme_text($section['title']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="hero__wrapper hero__wrapper-mobile">
        <div class="hero__box hero__box-swiper">
            <div class="swiper-wrapper hero__box__group">
                <?php if (!empty($slides)) : ?>
                    <?php foreach ($slides as $text) : ?>
                        <div class="swiper-slide hero__box__content">
                            <div class="hero__box__quotes blue">“</div>
                            <div class="hero__box__text">
                                <p><?php echo theme_text($text['content']); ?></p>
                            </div>
                            <div class="hero__box__under">
                                <div class="hero__box__author">
                                    <span class="hero__box__author-name">
                                        <?php echo theme_text($text['author_name']); ?>
                                    </span>
                                    <span class="hero__box__author-city">
                                        <?php echo theme_text($text['author_city']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="hero__box__buttons">
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
        </div>
    </div>
</section>