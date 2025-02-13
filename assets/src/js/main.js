
function tabs() {
  const tabs = document.querySelector('.document__tabs');
  if (!tabs) return;

  const tabHeaders = tabs.querySelectorAll('.document__head__item');
  const tabContents = tabs.querySelectorAll('.document__tabs__item');

  tabHeaders.forEach(header => {
    header.addEventListener('click', function () {
      const targetId = this.getAttribute('data-id');
      tabHeaders.forEach(h => h.classList.remove('active'));
      this.classList.add('active');
      tabContents.forEach(content => content.classList.remove('active'));
      const targetContent = document.getElementById(targetId);
      if (targetContent) {
        targetContent.classList.add('active');
      }
    });
  });
}

function funcyboxInit() {
  Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });
}

function accordion() {
  const accordion = document.querySelector('.accordion');
  if (!accordion) return

  document.querySelectorAll('.accordion__header').forEach(item => {
    item.addEventListener('click', function () {
      const parent = this.parentElement;
      const isActive = parent.classList.contains("active");

      document.querySelectorAll(".accordion__item").forEach(item => {
        item.classList.remove("active");
      });

      if (!isActive) {
        parent.classList.add("active");
      }
    });
  });
}

function headerMenu() {
  const btnMenu = document.querySelector('.header__button-menu');

  if (!btnMenu) return;

  btnMenu.addEventListener('click', function () {
    const isActive = btnMenu.classList.contains('active');

    if (isActive) {
      document.querySelector('.header__button-menu .open').classList.add('active');
      document.querySelector('.header__button-menu .close').classList.remove('active');
      document.querySelector('.header__dropdown').classList.remove('active');
    } else {
      document.querySelector('.header__button-menu .open').classList.remove('active');
      document.querySelector('.header__button-menu .close').classList.add('active');
      document.querySelector('.header__dropdown').classList.add('active');
    }
    btnMenu.classList.toggle('active');
  });

}

function heroSwiper() {
  if (document.querySelector('.hero__slider-swiper')) {

    const imageswiper = new Swiper('.hero__slider-swiper', {
      slidesPerView: 1,
      loop: true,
      speed: 800,
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
      speed: 100,
      allowTouchMove: false,
    });

    document.querySelector('.next').addEventListener('click', function () {
      textSwiper.slideNext();
      this.classList.add('active');
      document.querySelector('.prev').classList.remove('active');
    });

    document.querySelector('.prev').addEventListener('click', function () {
      textSwiper.slidePrev();
      this.classList.add('active');
      document.querySelector('.next').classList.remove('active');
    });

  }
}

document.addEventListener('DOMContentLoaded', function () {
  headerMenu();
  heroSwiper();
  tabs();
  accordion();
  funcyboxInit();
});