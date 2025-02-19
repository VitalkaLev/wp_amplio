<?php
$help_title = get_field('acf_help_title');
$help_items = get_field('acf_help_items');
?>

<section id="help" class="section help animate-fade" data-delay="0.3s">
    <div class="help__container">
        <?php if (!empty($help_title)) : ?>
            <h2><?php echo theme_text($help_title); ?></h2>
        <?php endif; ?>
        <div class="help__list">
            <?php if (!empty($help_items)) : ?>
                <?php foreach ($help_items as $item) : ?>
                    <div class="help__item">
                        <?php if (!empty($item['title'])) : ?>
                            <h3><?php echo theme_text($item['title']); ?></h3>
                        <?php endif; ?>
                        <div class="help__item__text">
                            <?php if (!empty($item['text'])) : ?>
                                <?php foreach ($item['text'] as $text) : ?>
                                    <p><?php echo theme_text($text); ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($item['images'])) : ?>
                            <div class="help__item__images">
                                <?php foreach ($item['images'] as $image) : ?>
                                    <a href="<?php echo esc_url($image['link']); ?>">
                                        <?php theme_image($image['image_id'], 300, 60, ''); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($item['hide_text'])) : ?>
                            <div class="help__item__hide">
                                <?php foreach ($item['hide_text'] as $hide_text) : ?>
                                    <p><?php echo theme_text($hide_text); ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($item['button_text'])) : ?>
                            <button type="button" class="btn-help btn-collapse" id="help-read">
                                <span class="open active"><?php echo theme_text($item['button_text']['open']); ?></span>
                                <span class="close"><?php echo theme_text($item['button_text']['close']); ?></span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>