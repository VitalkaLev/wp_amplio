<?php
$title = get_field('acf_step_title');
$subtitle = get_field('acf_step_subtitle');
$steps_items = get_field('acf_step_items');
$button = get_field('acf_step_button');
$button_text = isset($button['button_text']) ? $button['button_text'] : '';
$button_link = isset($button['button_link']) ? $button['button_link'] : '';
$button_icon = isset($button['button_icon']) ? $button['button_icon'] : '';

if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else {
?>
<section id="steps" class="section step animate-fade" data-delay="0.3s">
    <div class="step__wrapper container">
        <div class="step__content">
            <?php if (!empty($title)) : ?>
                <h2><?php echo theme_text($title); ?></h2>
            <?php endif; ?>
        </div>
        <div class="step__group">
            <div class="step__items">
                <?php if (!empty($steps_items)) : ?>
                    <?php foreach ($steps_items as $index => $item) : ?>
                        <div class="step__item">
                            <span class="step__item__number">
                                <?php echo theme_text($item['title']); ?>
                            </span>
                            <div class="step__item__text">
                                <p><?php echo theme_text($item['text']); ?></p>
                            </div>
                            <div class="step__item__decor">
                                <svg width="145" height="290" viewBox="0 0 145 290" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.232422 0.508301V289.86L144.909 145.184L0.232422 0.508301Z" fill="url(#paint0_radial_481_284_<?php esc_attr_e($index); ?>)" fill-opacity="0.5"/>
                                    <defs>
                                    <radialGradient id="paint0_radial_481_284_<?php esc_attr_e($index); ?>" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(145.436 141.844) rotate(178.682) scale(145.242 155.549)">
                                        <stop offset="0" stop-color="#8DA4FF"/>
                                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                                    </radialGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="step__box">
                <?php if (!empty($button_text) && !empty($button_link)) : ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn-primary h-bg green">
                        <span><?php echo theme_text($button_text); ?></span>
                        <?php if ($button_icon == false) { ?>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.48409 5.00008H11.1508M11.1508 11.6667V15.0001M11.1508 8.33341H11.1591M7.81742 8.33341H7.82576M4.48409 8.33341H4.49242M7.81742 11.6667H7.82576M4.48409 11.6667H4.49242M7.81742 15.0001H7.82576M4.48409 15.0001H4.49242M2.81742 1.66675H12.8174C13.7379 1.66675 14.4841 2.41294 14.4841 3.33341V16.6667C14.4841 17.5872 13.7379 18.3334 12.8174 18.3334H2.81742C1.89695 18.3334 1.15076 17.5872 1.15076 16.6667V3.33341C1.15076 2.41294 1.89695 1.66675 2.81742 1.66675Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php } ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($subtitle)) : ?>
                    <p><?php echo theme_text($subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>