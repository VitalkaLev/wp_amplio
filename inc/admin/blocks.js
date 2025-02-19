
function heroSwiper() {
    const label = document.querySelector('.hero__label');
    const title = document.querySelector('.hero__title h1');
    if (label && title) {
      title.appendChild(label);
    }
    if (document.querySelector('.hero__slider-swiper')) {
  
      const imageswiper = new Swiper('.hero__slider-swiper', {
        slidesPerView: 1,
        loop: true,
        speed: 1000,
        effect: "slide",
        allowTouchMove: false,
        navigation: {
          nextEl: '.next',
          prevEl: '.prev',
        }
      });
  
      const textSwiper = new Swiper('.hero__box-swiper', {
        effect: 'fade',
        loop: true,
        slidesPerView: 1,
        speed: 1000,
        allowTouchMove: false,
      });
  
      // Синхронізація при автоматичному переході
      imageswiper.on('slideChangeTransitionStart', function () {
        textSwiper.slideToLoop(imageswiper.realIndex);
      });
  
      textSwiper.on('slideChangeTransitionStart', function () {
        imageswiper.slideToLoop(textSwiper.realIndex);
      });
  
      // Синхронізація при кліках на стрілки
      document.querySelector('.next').addEventListener('click', function () {
        imageswiper.slideNext();
        textSwiper.slideNext();
        this.classList.add('active');
        document.querySelector('.prev').classList.remove('active');
      });
  
      document.querySelector('.prev').addEventListener('click', function () {
        imageswiper.slidePrev();
        textSwiper.slidePrev();
        this.classList.add('active');
        document.querySelector('.next').classList.remove('active');
      });
  
    }
}

function isBlockInPreview($el) {
  return $el.closest('.acf-block-component').hasClass('acf-block-preview');
}

function loaded() {
  heroSwiper();
}

function initBlocks() {
 
  acf.addAction('render_block', function ($el, attributes) {
    handleBlockModeChange($el);
  });
  
  acf.addAction('append', function ($el) {
    handleBlockModeChange($el);
  });
  
  acf.addAction('ready', function () {
    $(".acf-block-component").each(function () {
        handleBlockModeChange($(this));
    });
  });
}

function handleBlockModeChange($el) {
  setTimeout(() => {
      if (!isBlockInPreview($el)) {
        loaded();
      }
  }, 200);
}




jQuery(document).ready(function ($) {

  initBlocks();

  $(document).on("click", ".components-toolbar__control", function () {
    let $block = $(this).closest(".acf-block-component");
    handleBlockModeChange($block);
  });

});