<?php
$title = get_field('acf_credit_title');
$sum = get_field('acf_credit_sum');
$term = get_field('acf_credit_term');
$month = get_field('acf_credit_mounth');
$text = get_field('acf_credit_text');
$debt = get_field('acf_credit_debt');
$total = get_field('acf_credit_total');
$button = get_field('acf_credit_button');
$button_text = isset($button['button_text']) ? $button['button_text'] : '';
$button_icon = isset($button['button_icon']) ? $button['button_icon'] : '';

if( isset( $block['data']['preview_image_help'] )) {
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else { ?>
    <section id="credit" class="section credit animate-fade" data-delay="0.3s">
        <div class="credit__wrapper">
            <div class="credit__inner">
                <div class="credit__left">
                    <?php if (!empty($title)) : ?>
                        <h2><?php echo theme_text($title); ?></h2>
                    <?php endif; ?>
                    <form method="POST" action="<?php theme_home_url(); ?>/online/" class="credit__form animate-fade" data-delay="0.7s">
                        <div class="credit__form__inner">
                            <div class="credit__form__row">
                                <?php if (!empty($sum)) : ?>
                                    <label><?php echo theme_text($sum); ?></label>
                                <?php endif; ?>
                                <input type="text" class="credit__form__input" id="credit_amount" value="20000 грн">
                                <input type="range" class="credit__form__range" id="credit_amount_range" min="1000" max="200000" value="20000" style="--value: 0%;">
                                <span class="credit__form__group">
                                    <span>1000 грн</span>
                                    <span>200 000 грн</span>
                                </span>
                            </div>

                            <div class="credit__form__row">
                                <?php if (!empty($term)) : ?>
                                    <label><?php echo theme_text($term); ?></label>
                                <?php endif; ?>
                                <input type="text" class="credit__form__input" id="term_amount" value="6">
                                <input id="term_range" class="credit__form__range" type="range" min="1" max="24" step="1" style="--value: 21.73913043478261%;">
                                <span class="credit__form__group">
                                    <span>6 місяців</span>
                                    <span>24 місяці</span>
                                </span>
                                <span class="credit__form__group term__buttons">
                                    <button class="term__button active" value="6">6 місяців</button>
                                    <button class="term__button" value="12">12 місяців</button>
                                    <button class="term__button" value="24">24 місяці</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="credit__right">
                    <div class="credit__box">
                        <div class="credit__text__item animate-fade" data-delay="0.4s">
                            <div class="credit__text__icon">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="60" height="60" rx="16" fill="#2046D2"></rect>
                                    <g clip-path="url(#clip0_888_12)">
                                    <path d="M39 24H23C22.141 24 21.328 23.628 20.765 23.001C21.315 22.387 22.114 22 23 22H41C42.308 21.994 42.307 20.005 41 20H23C20.239 20 18 22.239 18 25V35C18 37.761 20.239 40 23 40H39C40.657 40 42 38.657 42 37V27C42 25.343 40.657 24 39 24ZM38 33C36.692 32.994 36.692 31.006 38 31C39.308 31.006 39.308 32.994 38 33Z" fill="white"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_888_12">
                                    <rect width="24" height="24" fill="white" transform="translate(18 18)"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="credit__text__content">
                                <?php if (!empty($month)) : ?>
                                    <p><?php echo theme_text($month); ?></p>
                                <?php endif; ?>
                                <span class="final-amount-month"></span>
                            </div>
                        </div>
                        <?php if (!empty($button)) : ?>
                            <button id="creditSubmit" class="btn btn-primary h-bg h-full green animate-fade <?php if(is_admin()){ echo 'btn-is-admin';} ?>" data-delay="0.5s">
                                <span><?php echo theme_text($button_text); ?></span>
                                <?php if($button_icon == false){ ?>
                                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.48409 5.00008H11.1508M11.1508 11.6667V15.0001M11.1508 8.33341H11.1591M7.81742 8.33341H7.82576M4.48409 8.33341H4.49242M7.81742 11.6667H7.82576M4.48409 11.6667H4.49242M7.81742 15.0001H7.82576M4.48409 15.0001H4.49242M2.81742 1.66675H12.8174C13.7379 1.66675 14.4841 2.41294 14.4841 3.33341V16.6667C14.4841 17.5872 13.7379 18.3334 12.8174 18.3334H2.81742C1.89695 18.3334 1.15076 17.5872 1.15076 16.6667V3.33341C1.15076 2.41294 1.89695 1.66675 2.81742 1.66675Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                <?php } ?>
                            </button>
                        <?php endif; ?>
                        <?php if (!empty($text)) : ?>
                            <span class="credit__text__note animate-fade" data-delay="0.7s"><?php echo theme_text($text); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="credit__text animate-fade" data-delay="0.5s">
                        <div class="credit__text__item">
                            <div class="credit__text__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_483_788)">
                                    <path d="M9 4C9 1.791 12.358 0 16.5 0C20.642 0 24 1.791 24 4C24 6.209 20.642 8 16.5 8C12.358 8 9 6.209 9 4ZM16.5 10C15.473 10 14.499 9.885 13.609 9.685C12.25 8.666 10.023 8 7.5 8C3.358 8 0 9.791 0 12C0 14.209 3.358 16 7.5 16C11.642 16 15 14.209 15 12C15 11.971 14.993 11.943 14.992 11.914H15V14C15 16.209 11.642 18 7.5 18C3.358 18 0 16.209 0 14V16C0 18.209 3.358 20 7.5 20C11.642 20 15 18.209 15 16V18C15 20.209 11.642 22 7.5 22C3.358 22 0 20.209 0 18V20C0 22.209 3.358 24 7.5 24C11.642 24 15 22.209 15 20V19.92C15.485 19.972 15.986 20 16.5 20C20.642 20 24 18.209 24 16V14C24 16.119 20.908 17.849 17 17.987V15.987C20.908 15.849 24 14.12 24 12V10C24 12.119 20.908 13.849 17 13.987V11.987C20.908 11.849 24 10.12 24 8V6C24 8.209 20.642 10 16.5 10Z" fill="#929292"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_483_788">
                                    <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="credit__text__content">
                                <?php if (!empty($debt)) : ?>
                                    <p><?php echo theme_text($debt); ?></p>
                                <?php endif; ?>
                                <span class="final-amount-costs"></span>
                            </div>
                        </div>
                        <div class="credit__text__item">
                            <div class="credit__text__icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_483_794)">
                                    <path d="M17 7C17 7.26522 16.8946 7.51957 16.7071 7.70711C16.5196 7.89464 16.2652 8 16 8H8C7.73478 8 7.48043 7.89464 7.29289 7.70711C7.10536 7.51957 7 7.26522 7 7C7 6.73478 7.10536 6.48043 7.29289 6.29289C7.48043 6.10536 7.73478 6 8 6H16C16.2652 6 16.5196 6.10536 16.7071 6.29289C16.8946 6.48043 17 6.73478 17 7ZM23 5V19C22.9984 20.3256 22.4711 21.5964 21.5338 22.5338C20.5964 23.4711 19.3256 23.9984 18 24H6C4.67441 23.9984 3.40356 23.4711 2.46622 22.5338C1.52888 21.5964 1.00159 20.3256 1 19V5C1.00159 3.67441 1.52888 2.40356 2.46622 1.46622C3.40356 0.528882 4.67441 0.00158786 6 0L18 0C19.3256 0.00158786 20.5964 0.528882 21.5338 1.46622C22.4711 2.40356 22.9984 3.67441 23 5ZM7 18C7 17.8022 6.94135 17.6089 6.83147 17.4444C6.72159 17.28 6.56541 17.1518 6.38268 17.0761C6.19996 17.0004 5.99889 16.9806 5.80491 17.0192C5.61093 17.0578 5.43275 17.153 5.29289 17.2929C5.15304 17.4327 5.0578 17.6109 5.01921 17.8049C4.98063 17.9989 5.00043 18.2 5.07612 18.3827C5.15181 18.5654 5.27998 18.7216 5.44443 18.8315C5.60888 18.9414 5.80222 19 6 19C6.26522 19 6.51957 18.8946 6.70711 18.7071C6.89464 18.5196 7 18.2652 7 18ZM7 14C7 13.8022 6.94135 13.6089 6.83147 13.4444C6.72159 13.28 6.56541 13.1518 6.38268 13.0761C6.19996 13.0004 5.99889 12.9806 5.80491 13.0192C5.61093 13.0578 5.43275 13.153 5.29289 13.2929C5.15304 13.4327 5.0578 13.6109 5.01921 13.8049C4.98063 13.9989 5.00043 14.2 5.07612 14.3827C5.15181 14.5654 5.27998 14.7216 5.44443 14.8315C5.60888 14.9414 5.80222 15 6 15C6.26522 15 6.51957 14.8946 6.70711 14.7071C6.89464 14.5196 7 14.2652 7 14ZM11 18C11 17.8022 10.9414 17.6089 10.8315 17.4444C10.7216 17.28 10.5654 17.1518 10.3827 17.0761C10.2 17.0004 9.99889 16.9806 9.80491 17.0192C9.61093 17.0578 9.43275 17.153 9.29289 17.2929C9.15304 17.4327 9.0578 17.6109 9.01921 17.8049C8.98063 17.9989 9.00043 18.2 9.07612 18.3827C9.15181 18.5654 9.27998 18.7216 9.44443 18.8315C9.60888 18.9414 9.80222 19 10 19C10.2652 19 10.5196 18.8946 10.7071 18.7071C10.8946 18.5196 11 18.2652 11 18ZM11 14C11 13.8022 10.9414 13.6089 10.8315 13.4444C10.7216 13.28 10.5654 13.1518 10.3827 13.0761C10.2 13.0004 9.99889 12.9806 9.80491 13.0192C9.61093 13.0578 9.43275 13.153 9.29289 13.2929C9.15304 13.4327 9.0578 13.6109 9.01921 13.8049C8.98063 13.9989 9.00043 14.2 9.07612 14.3827C9.15181 14.5654 9.27998 14.7216 9.44443 14.8315C9.60888 14.9414 9.80222 15 10 15C10.2652 15 10.5196 14.8946 10.7071 14.7071C10.8946 14.5196 11 14.2652 11 14ZM19 18C19 17.7348 18.8946 17.4804 18.7071 17.2929C18.5196 17.1054 18.2652 17 18 17H14C13.7348 17 13.4804 17.1054 13.2929 17.2929C13.1054 17.4804 13 17.7348 13 18C13 18.2652 13.1054 18.5196 13.2929 18.7071C13.4804 18.8946 13.7348 19 14 19H18C18.2652 19 18.5196 18.8946 18.7071 18.7071C18.8946 18.5196 19 18.2652 19 18ZM14 15C14.1978 15 14.3911 14.9414 14.5556 14.8315C14.72 14.7216 14.8482 14.5654 14.9239 14.3827C14.9996 14.2 15.0194 13.9989 14.9808 13.8049C14.9422 13.6109 14.847 13.4327 14.7071 13.2929C14.5673 13.153 14.3891 13.0578 14.1951 13.0192C14.0011 12.9806 13.8 13.0004 13.6173 13.0761C13.4346 13.1518 13.2784 13.28 13.1685 13.4444C13.0586 13.6089 13 13.8022 13 14C13 14.2652 13.1054 14.5196 13.2929 14.7071C13.4804 14.8946 13.7348 15 14 15ZM19 14C19 13.8022 18.9414 13.6089 18.8315 13.4444C18.7216 13.28 18.5654 13.1518 18.3827 13.0761C18.2 13.0004 17.9989 12.9806 17.8049 13.0192C17.6109 13.0578 17.4327 13.153 17.2929 13.2929C17.153 13.4327 17.0578 13.6109 17.0192 13.8049C16.9806 13.9989 17.0004 14.2 17.0761 14.3827C17.1518 14.5654 17.28 14.7216 17.4444 14.8315C17.6089 14.9414 17.8022 15 18 15C18.2652 15 18.5196 14.8946 18.7071 14.7071C18.8946 14.5196 19 14.2652 19 14ZM19 7C19 6.20435 18.6839 5.44129 18.1213 4.87868C17.5587 4.31607 16.7956 4 16 4H8C7.20435 4 6.44129 4.31607 5.87868 4.87868C5.31607 5.44129 5 6.20435 5 7C5 7.79565 5.31607 8.55871 5.87868 9.12132C6.44129 9.68393 7.20435 10 8 10H16C16.7956 10 17.5587 9.68393 18.1213 9.12132C18.6839 8.55871 19 7.79565 19 7Z" fill="#929292"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_483_794">
                                    <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="credit__text__content">
                                <?php if (!empty($total)) : ?>
                                    <p><?php echo theme_text($total); ?></p>
                                <?php endif; ?>
                                <span class="final-amount-uah"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
            