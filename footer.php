<?php
$logo = get_field('acf_footer_logo','option');
$menu = get_field('acf_footer_menu','option');
$menu_bottom = get_field('acf_footer_menu_bottom','option');
$socials = get_field('acf_footer_socials','option');
$email = get_field('acf_footer_email','option');
$tel = get_field('acf_footer_tel','option');
$copyright = get_field('acf_footer_copyright','option');
$market = get_field('acf_footer_text_market','option');
$bottom_text = get_field('acf_footer_text','option');
?>
    <footer class="footer">
        <div class="footer__wrapper">
            <div class="footer__bottom">
                <div class="footer__group">
                    <div class="footer__logo">
                        <a href="<?php theme_home_url(); ?>">
                            <?php theme_image($logo, '164','70'); ?>
                        </a>
                        <div class="footer__info">                              
                            <a href="<?php echo esc_url('tel:'.$tel); ?>" class="content-section-text">
                                <?php echo theme_text($tel); ?>
                            </a>
                            <a href="<?php echo esc_url('mailto:'.$email); ?>">
                                <?php echo theme_text($email); ?>
                            </a>
                        </div>
                    </div>
                    <nav class="footer__nav footer__nav-2">
                        <?php if( !empty($menu) ){ ?>
                            <ul>
                                <?php foreach ($menu as $item) { ?>
                                    <li>
                                        <a href="<?php echo esc_url($item['url']); ?>">
                                            <?php echo theme_text($item['name']); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </nav>  
                    <div class="footer__content">
                        <?php the_field('acf_footer_text_market','option'); ?>
                    </div>
                </div>
                <div class="footer__group">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <?php echo theme_text($copyright); ?>
                            </p>
                            <nav class="footer__nav">
                                <?php if( !empty($menu_bottom) ){ ?>
                                    <ul>
                                        <?php foreach ($menu_bottom as $item) { ?>
                                            <li>
                                                <a href="<?php echo esc_url($item['url']); ?>">
                                                    <?php echo theme_text($item['name']); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </nav>
                        </div>
                        <?php if( !empty($socials) ){ ?>
                            <div class="footer__social">
                                <?php foreach ($socials as $item) { ?>
                                    <a target="_blank" href="<?php echo esc_url($item['url']); ?>">
                                        <?php echo $item['icon']; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>
            <div class="footer__text">
               <?php echo theme_text($bottom_text); ?>
            </div>
        </div>
    </footer>
    </div>
    <?php the_field('acf_body_end','option'); ?>
<?php wp_footer(); ?>
</body>
</html>