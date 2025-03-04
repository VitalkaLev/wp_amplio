<?php
$title = get_field('acf_help_title');
$items = get_field('acf_help_items');

if( empty($items) ){
    $items = [
        0 => [
            'title' => 'В особистому <br> кабінеті Amplio',
            'url' => '',
            'image_desktop' => '',
            'image_mobile' => '',
            'text' => '
                <p>
                    Ви можете погасити Ваш кредит онлайн не виходячи з дому.
                </p>
                <p>
                    Просто перейдіть в особистий кабінет <br> Amplio та сплатіть кредит банківською картою
                </p>
            ',
            'text_collapse' => ''
        ],
        1 => [
            'title' => 'Через платіжні <br> термінали',
            'url' => '',
            'image_desktop' => '',
            'image_mobile' => '',
            'text' => '
                <p>
                    Оплата кредиту в терміналі EasyPay та City24 – це швидко та зручно.
                </p>
                <p>
                    Термінал Ви зможете знайти у найближчому до Вас супермаркеті.
                </p>
            ',
            'text_collapse' => ''
        ],
        2 => [
            'title' => 'Через каси та інтернет <br> сервіси Банків України',
            'url' => '',
            'image_desktop' => '',
            'image_mobile' => '',
            'text' => '
                <p>
                Ви можете погасити Ваш кредит в касі будь-якого банку України або через доступний інтернет-банкінг Вашого Банку. Погашення відбувається за реквізитами:
                </p>
            ',
            'text_collapse' => '
                <p>
                    ТОВ «1 БЕЗПЕЧНЕ АГЕНТСТВО НЕОБХІДНИХ КРЕДИТІВ»  
                </p>
                <p>
                    Код ЄДРПОУ:39861924
                </p>
                <p>
                    IBAN: UA563395000000026508558790001
                </p>
                <p>
                    Банк отримувача: АТ “ТАСКОМБАНК”
                </p>
                <p>
                    Банк отримувача: АТ “ТАСКОМБАНК”
                </p>
                <p>
                    В призначенні платежу вкажіть:
                </p>
                <p>
                    «Погашення кредиту» і ОБОВ’ЯЗКОВО вкажіть своє ПІБ, ІПН та номер кредитного договору, <br> 
                </p>
                <p>
                    інакше ми не зможемо ідентифікувати платіж і ваш кредит не буде погашено
                </p>
            '
        ],
        
    ];

}

if( isset( $block['data']['preview_image_help'] )) {
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else { ?>
    <section id="help" class="section help animate-fade" data-delay="0.3s">
        <div class="help__container">
            <div class="help__head">
                <?php if (!empty($title)) : ?>
                    <h2><?php echo theme_text($title); ?></h2>
                <?php endif; ?>
            </div>
            <div class="help__list">
                <?php if (!empty($items)) : ?>
                    <?php foreach ($items as $index => $item) : $index = $index + 1; ?>
                        <div class="help__item">
                            <div class="help__item__inner">
                                <?php if (!empty($item['title'])) : ?>
                                    <h3><?php echo theme_text($item['title']); ?></h3>
                                <?php endif; ?>
                                <div class="help__item__text">
                                    <?php if (!empty($item['text_short'])) : ?>
                                        <p><?php echo theme_text($item['text_short']); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($item['text_collapse'])) : ?>
                                        <div class="help__item__hide">
                                            <p><?php echo theme_text($item['text_collapse']); ?></p>
                                        </div>
                                        <button type="button" class="btn-help btn-collapse" id="help-read">
                                            <span class="open active"><?php _e('Детальніше', THEME); ?></span>
                                            <span class="close"><?php _e('Згорнути', THEME); ?></span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="help__item__images">
                                <picture>
                                    <?php if( !empty($item['image_desktop']) ){ ?>
                                        <?php if( isset($item['image_mobile']) && !empty($item['image_mobile']) ){ ?>
                                            <source srcset="<?php echo theme_image_url($item['image_mobile'], 300, 300, ''); ?>" media="(max-width: 768px)">
                                        <?php } ?>
                                            <?php theme_image($item['image_desktop'], 300, 300, ''); ?>
                                    <?php } else { ?>
                                        <source srcset="<?php echo ASSETS . "/images/visa-{$index}.png"; ?>" media="(max-width: 768px)">
                                        <img width="300" height="60" src="<?php echo ASSETS . "/images/visa-{$index}.png"; ?>" loading="lazy" alt="pay">
                                    <?php } ?>
                                </picture>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php }
