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

function lazyLoad(){
  // const images = document.querySelectorAll("img[loading='lazy']");
    
  // images.forEach(img => {
  //     img.classList.add("blurred");
  //     img.addEventListener("load", () => {
  //         img.classList.remove("blurred");
  //     });
  // });
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

function faq() {
  const accordion = document.querySelector('.faq');
  if (!accordion) return

    document.querySelectorAll('.faq__head').forEach(item => {
      if (!item.classList.contains('faq__head--link')) {
        item.addEventListener('click', function () {
          const parent = this.parentElement;
          const isActive = parent.classList.contains("active");

          document.querySelectorAll(".faq__item").forEach(item => {
            item.classList.remove("active");
          });

          if (!isActive) {
            parent.classList.add("active");
          }
        });
      }
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
      document.querySelector('.header__actions').classList.remove('active');
      document.querySelector('.header__wrapper').classList.remove('active');
    } else {
      document.querySelector('.header__button-menu .open').classList.remove('active');
      document.querySelector('.header__button-menu .close').classList.add('active');
      document.querySelector('.header__dropdown').classList.add('active');
      document.querySelector('.header__actions').classList.add('active');
      document.querySelector('.header__wrapper').classList.add('active');
    }
    btnMenu.classList.toggle('active');
  });

}

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
      autoplay: {
        delay: 3000,
      },
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
      autoplay: {
        delay: 3000,
      },
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


function creditCalculator() {
  const creditSection = document.querySelector('.credit');

  if (!creditSection) return;

  const creditRange = document.getElementById('credit_amount_range');
  const creditDisplay = document.getElementById('credit_amount');
  const termRange = document.getElementById('term_range');
  const termDisplay = document.getElementById('term_amount');
  const termButtons = document.querySelectorAll('.term__button');
  const creditSubmit = document.getElementById('creditSubmit');

  const finalAmountUAH = document.querySelector('.final-amount-uah');
  const finalAmountMonth = document.querySelector('.final-amount-month');
  const finalAmountCosts = document.querySelector('.final-amount-costs');

  const minCredit = parseInt(creditRange.min, 10);
  const maxCredit = parseInt(creditRange.max, 10);
  const allowedTerms = [6, 12, 24];
  let selectedTerm = 6; // Фіксуємо стандартний термін

  function getMonthLabel(value) {
    if (value === 1) return "місяць";
    if (value > 1 && value < 5) return "місяці";
    return "місяців";
  }

  function updateCreditValue(value) {
    creditRange.value = value;
    creditDisplay.value = `${value} грн`;
    updateFinalAmounts();
  }

  function updateRangeStyle(rangeInput) {
    const percentage = ((rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min)) * 100;
    rangeInput.style.setProperty('--value', `${percentage}%`);
  }

  function updateTermValue(value) {
    if (!allowedTerms.includes(value)) return;
    selectedTerm = value;

    termRange.value = value;
    termDisplay.value = `${value} ${getMonthLabel(value)}`;
    updateRangeStyle(termRange);
    
    termButtons.forEach(btn => btn.classList.remove('active'));
    const activeButton = document.querySelector(`.term__button[value="${value}"]`);
    if (activeButton) activeButton.classList.add('active');

    updateFinalAmounts();
  }

  function snapToAllowedTerm(value) {
    return allowedTerms.reduce((prev, curr) => Math.abs(curr - value) < Math.abs(prev - value) ? curr : prev);
  }

  function updateFinalAmounts() {
    let totalAmount = parseInt(creditRange.value, 10);
    let term = selectedTerm;
    let oneTimeFee = 1380;
    let monthlyInterestRate = 0.00000833;
    let monthlyFee = ((totalAmount + oneTimeFee) * 0.069 + Number.EPSILON) * 100 / 100;
    let initialDebt = totalAmount + oneTimeFee;
    let annuityPayment = (initialDebt * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -term))* 100 / 100;
    let totalMonthlyPayment = ((annuityPayment + monthlyFee) * 100) / 100;
    let totalCreditCost = totalMonthlyPayment * term;
    let totalLoanExpenses = totalCreditCost - totalAmount;

    finalAmountUAH.textContent = `${parseFloat(totalCreditCost).toFixed(2)} грн`;
    finalAmountMonth.textContent = `${parseFloat(annuityPayment).toFixed(2)} грн/міс`;
    finalAmountCosts.textContent = `${parseFloat(totalLoanExpenses).toFixed(2)} грн`;
  }

  function handleCreditSubmit() {
    const totalAmount = finalAmountUAH.textContent;
    const monthlyPayment = finalAmountMonth.textContent;
    const totalCosts = finalAmountCosts.textContent;
    const totalCredit = document.querySelector('#credit_amount').value;

    alert(`Кредит оформлено:\nЗагальна сума: ${totalAmount}\nЩомісячний платіж: ${monthlyPayment}\nЗагальні витрати: ${totalCosts}\nСума кредиту: ${totalCredit}\nТермін: ${selectedTerm} ${getMonthLabel(selectedTerm)}`);
  }

  if (creditSubmit) creditSubmit.addEventListener('click', handleCreditSubmit);

  creditRange.addEventListener('input', (e) => {
    updateCreditValue(e.target.value);
    updateRangeStyle(creditRange);
  });

  creditDisplay.addEventListener('input', () => {
    setTimeout(() => {
      let value = parseInt(creditDisplay.value.replace(/\D/g, ''), 10) || minCredit;
      value = Math.min(Math.max(value, minCredit), maxCredit);
      updateCreditValue(value);
      updateRangeStyle(creditRange);
    }, 1000);
  });

  termRange.addEventListener('input', (e) => {
    const snappedValue = snapToAllowedTerm(parseInt(e.target.value, 10));
    updateTermValue(snappedValue);
  });

  termButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      updateTermValue(parseInt(button.value, 10));
    });
  });

  updateCreditValue(creditRange.value);
  updateTermValue(selectedTerm);
  updateRangeStyle(creditRange);
  updateRangeStyle(termRange);
  updateFinalAmounts();
}

function fadeInSections() {
  const sections = document.querySelectorAll('.animate-fade');

  function checkFadeIn() {
    const windowHeight = window.innerHeight;
    
    sections.forEach(section => {
      const rect = section.getBoundingClientRect();
      if (rect.top < windowHeight - 50) { 
        section.style.opacity = '1';
        section.style.transition = 'opacity 0.6s ease-out';
      }
    });
  }

  window.addEventListener('scroll', checkFadeIn);
  window.addEventListener('load', checkFadeIn); // Запускаємо при завантаженні сторінки
}

function helperCollapse() {
  const btnCollapse = document.querySelector('.btn-collapse');

  if (!btnCollapse) return;

  btnCollapse.addEventListener('click', function () {
    const textElement = document.querySelector('.help__item__hide');
    const openIcon = document.querySelector('.btn-collapse .open');
    const closeIcon = document.querySelector('.btn-collapse .close');

    const isActive = textElement.classList.contains('active');

    if (!isActive) {
      textElement.classList.add('active');
      openIcon.classList.remove('active');
      closeIcon.classList.add('active');
    } else {
      textElement.classList.remove('active');
      openIcon.classList.add('active');
      closeIcon.classList.remove('active');
    }
  });
}


document.addEventListener('DOMContentLoaded', function () {
  lazyLoad();
  fadeInSections();
  headerMenu();
  heroSwiper();
  tabs();
  accordion();
  funcyboxInit();
  creditCalculator();
  faq();
  helperCollapse();
});