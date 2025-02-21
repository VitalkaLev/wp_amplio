<?php
$title = get_field('acf_document_title');
$image = get_field('acf_document_image');
$tabs_head_1 = get_field('acf_document_tab_title_1');
$tabs_head_2 = get_field('acf_document_tab_title_2');
$tabs_head_3 = get_field('acf_document_tab_title_3');
$document_categories = get_field('acf_document_categories');
$document_two_items = get_field('acf_document_two_items');
$document_one_items = get_field('acf_document_one_items');
$button = get_field('acf_document_button');
$button_text = isset($button['button_name']) ? $button['button_name'] : '';
$button_link = isset($button['button_url']) ? $button['button_url'] : '';
$button_icon = isset($button['button_icon']) ? $button['button_icon'] : '';

if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto; display: block; margin: 0 auto;">';
} else {
?>
<section id="documents" class="section document animate-fade" data-delay="0.3s">
    <div class="document__wrapper">
        <div class="document__group">
            <div class="document__wrapper__inner">
                <div class="document__content">
                    <?php if (!empty($title)) : ?>
                        <h2><?php echo theme_text($title); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="document__tabs">
                    <div class="document__tabs__head">
                        <button data-id="tab-1" class="document__head__item active">
                            <?php echo theme_text($tabs_head_1); ?>
                        </button>
                        <button data-id="tab-2" class="document__head__item">
                            <?php echo theme_text($tabs_head_2); ?>
                        </button>
                        <button data-id="tab-3" class="document__head__item">
                            <?php echo theme_text($tabs_head_3); ?>
                        </button>
                    </div>
                    <div class="document__tabs__content animate-fade">
                        <?php if (!empty($document_two_items)){ ?>
                            <div id="tab-1" class="document__tabs__item active">
                                <div class="table">
                                    <?php foreach ($document_two_items as $item) : ?>
                                        <div class="table__row">
                                            <div class="table__item table__item-title">
                                                <span><?php echo theme_text($item['title']); ?></span>
                                            </div>
                                            <div class="table__item table__item-value">
                                                <span><?php echo theme_text($item['value']); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($document_categories)){ ?>
                            <div id="tab-2" class="document__tabs__item">
                                <div class="accordion">
                                    <?php foreach ($document_categories as $index => $document_category){
                                        
                                        $category_name = $document_category->name; 

                                        $documents = get_posts([
                                            'post_type' => 'documents',
                                            'numberposts' => -1,
                                            'post_status' => 'publish',
                                            'order' => 'DESC',
                                            'orderby' => 'date',
                                            'tax_query' => [
                                                [
                                                    'taxonomy' => 'document_category',
                                                    'field' => 'term_id',
                                                    'terms' => $document_category->term_id,
                                                ],
                                            ],
                                            'fields' => 'ids'
                                        ]);
                                        ?>
                                        <div class="accordion__item <?php if($index == 1){ echo 'active'; } ?>">
                                            <button class="accordion__header">
                                                <?php echo theme_text($category_name); ?>
                                                <span class="accordion__icon">
                                                    <svg width="60" height="61" viewBox="0 0 60 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M31 23.348C31 22.7957 30.5523 22.348 30 22.348C29.4477 22.348 29 22.7957 29 23.348H31ZM29.2929 39.0551C29.6834 39.4457 30.3166 39.4457 30.7071 39.0551L37.0711 32.6912C37.4616 32.3006 37.4616 31.6675 37.0711 31.277C36.6805 30.8864 36.0474 30.8864 35.6569 31.277L30 36.9338L24.3431 31.277C23.9526 30.8864 23.3195 30.8864 22.9289 31.277C22.5384 31.6675 22.5384 32.3006 22.9289 32.6912L29.2929 39.0551ZM29 23.348V38.348H31V23.348H29Z" fill="#7F7F7F"/>
                                                    </svg>
                                                </span>
                                            </button>
                                            <div class="accordion__content">
                                                <?php 
                                                if($documents){
                                                    foreach ($documents as $item) {
                                                        $pdf = get_field('acf_document_pdf',$item);
                                                        ?>
                                                        <div class="accordion__content__item" <?php if( !empty($pdf) ){ ?> data-fancybox data-type="iframe" data-src="<?php echo esc_url($pdf); ?>" <?php } ?>>
                                                            <svg width="28" height="33" viewBox="0 0 28 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M18 11.2684H26.72C26.2545 10.0349 25.5313 8.9149 24.5987 7.98309L19.9534 3.33509C19.0204 2.40353 17.9001 1.68084 16.6667 1.21509V9.93509C16.6667 10.6714 17.2636 11.2684 18 11.2684Z" fill="#EBEEFA"/>
                                                                <path d="M27.3013 13.935H18C15.7909 13.935 14 12.1441 14 9.935V0.633685C13.7853 0.618997 13.5707 0.601685 13.3533 0.601685H7.33331C3.65325 0.606122 0.671062 3.58831 0.666687 7.26837V25.9351C0.671062 29.6151 3.65325 32.5973 7.33331 32.6017H20.6666C24.3467 32.5973 27.3289 29.6151 27.3333 25.935V14.5817C27.3333 14.3644 27.316 14.1497 27.3013 13.935Z" fill="#EBEEFA"/>
                                                            </svg>
                                                            <div class="accordion__text">
                                                                <p><?php echo theme_text(get_the_title($item)); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                } 
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($document_one_items)) { ?>
                            <div id="tab-3" class="document__tabs__item">
                                <div class="table table--full">
                                    <?php foreach ($document_one_items as $item) : ?>
                                        <div class="table__row">
                                            <div class="table__item table__item-title">
                                                <span><?php echo theme_text($item['title']); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if (!empty($button)) : ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn-primary h-bg green">
                        <span><?php echo theme_text($button_text); ?></span>
                        <?php if($button_icon == false){ ?>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.48409 5.00008H11.1508M11.1508 11.6667V15.0001M11.1508 8.33341H11.1591M7.81742 8.33341H7.82576M4.48409 8.33341H4.49242M7.81742 11.6667H7.82576M4.48409 11.6667H4.49242M7.81742 15.0001H7.82576M4.48409 15.0001H4.49242M2.81742 1.66675H12.8174C13.7379 1.66675 14.4841 2.41294 14.4841 3.33341V16.6667C14.4841 17.5872 13.7379 18.3334 12.8174 18.3334H2.81742C1.89695 18.3334 1.15076 17.5872 1.15076 16.6667V3.33341C1.15076 2.41294 1.89695 1.66675 2.81742 1.66675Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        <?php } ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="document__image">
                <?php theme_image($image,'520','640'); ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>