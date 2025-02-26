<?php
$why_title = get_field('acf_why_title');
$why_description = get_field('acf_why_subtitle');
$why_items = get_field('acf_why_items');

if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else {
?>
<section id="why" class="section why">
    <div class="why__wrapper container">
        <div class="why__content animate-fade" data-delay="0.3s">
            <?php if (!empty($why_title)) : ?>
                <h2><?php echo theme_text($why_title); ?></h2>
            <?php endif; ?>
            <?php if (!empty($why_description)) : ?>
                <p><?php echo theme_text($why_description); ?></p>
            <?php endif; ?>
        </div>
        <div class="why__items">
            <?php if (!empty($why_items)) : ?>
                <?php foreach ($why_items as $item) : ?>
                    <div class="why__item animate-fade" data-delay="0.3s" style="background: <?php echo esc_attr($item['background_color']); ?>;">
                        <?php if (!empty($item['title'])) : ?>
                            <h3><?php echo theme_text($item['title']); ?></h3>
                        <?php endif; ?>
                        <picture>
                            <?php if( isset($item['image_mobile']) && !empty($item['image_mobile']) ){ ?>
                                <source srcset="<?php echo theme_image_url($item['image_mobile'], 280, 203, ''); ?>" media="(max-width: 768px)">
                            <?php } ?>
                            <?php theme_image($item['image_desktop'], 280, 203, ''); ?>
                        </picture>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php } ?>