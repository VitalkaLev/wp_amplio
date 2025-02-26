<?php
$title = get_field('acf_faq_title');
$items = get_field('acf_faq_items');

if( isset( $block['data']['preview_image_help'] )) {
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else { ?>
    <section id="faq" class="section faq animate-fade" data-delay="0.3s">
        <div class="faq__container">
            <div class="faq__head">
                <?php if (!empty($title)) : ?>
                    <h2><?php echo theme_text($title); ?></h2>
                <?php endif; ?>
            </div>
            <div class="faq__list">
                <?php if (!empty($items)) : ?>
                    <?php foreach ($items as $item) : ?>
                        <div class="faq__item">
                            <?php if (!empty($item['link'])) : ?>
                                <a class="faq__head faq__head--link" href="<?php echo esc_url($item['link']); ?>"> 
                                    <span><?php echo theme_text($item['title']); ?></span>
                                    <div class="faq__icon">
                                        <svg width="60" height="61" viewBox="0 0 60 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M31 23.348C31 22.7957 30.5523 22.348 30 22.348C29.4477 22.348 29 22.7957 29 23.348H31ZM29.2929 39.0551C29.6834 39.4457 30.3166 39.4457 30.7071 39.0551L37.0711 32.6912C37.4616 32.3006 37.4616 31.6675 37.0711 31.277C36.6805 30.8864 36.0474 30.8864 35.6569 31.277L30 36.9338L24.3431 31.277C23.9526 30.8864 23.3195 30.8864 22.9289 31.277C22.5384 31.6675 22.5384 32.3006 22.9289 32.6912L29.2929 39.0551ZM29 23.348V38.348H31V23.348H29Z" fill="#7F7F7F"></path>
                                        </svg>
                                    </div>
                                </a>
                            <?php else : ?>
                                <button type="button" class="faq__head"> 
                                    <span><?php echo theme_text($item['title']); ?></span>
                                    <span class="faq__icon">
                                        <svg width="60" height="61" viewBox="0 0 60 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M31 23.348C31 22.7957 30.5523 22.348 30 22.348C29.4477 22.348 29 22.7957 29 23.348H31ZM29.2929 39.0551C29.6834 39.4457 30.3166 39.4457 30.7071 39.0551L37.0711 32.6912C37.4616 32.3006 37.4616 31.6675 37.0711 31.277C36.6805 30.8864 36.0474 30.8864 35.6569 31.277L30 36.9338L24.3431 31.277C23.9526 30.8864 23.3195 30.8864 22.9289 31.277C22.5384 31.6675 22.5384 32.3006 22.9289 32.6912L29.2929 39.0551ZM29 23.348V38.348H31V23.348H29Z" fill="#7F7F7F"></path>
                                        </svg>
                                    </span>
                                </button>
                            <?php endif; ?>
                            <div class="faq__content">
                                <?php echo theme_text($item['text']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php } ?>