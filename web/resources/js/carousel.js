import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

const carouselElement = document.getElementById('carousel');
const dotsElement = document.getElementById('dots');

const emblaApi = EmblaCarousel(
  carouselElement,
  {
    align: 'start',
    loop: true,
    watchDrag: true,
    slidesToScroll: 'auto',
    containScroll: 'trimSnaps',
    breakpoints: {
      '(min-width: 768px)': {
        slidesToScroll: 2,
      },
    },
  },
  [
    Autoplay({
      stopOnInteraction: false,
    }),
  ]
);

const addDotBtnsAndClickHandlers = (emblaApi, dotsElement) => {
  let dotElements = [];

  const addDotBtnsWithClickHandlers = () => {
    dotsElement.innerHTML = emblaApi
      .scrollSnapList()
      .map(
        () =>
          '<button class="inline-block h-2.5 min-w-[10px] w-full max-w-[10px] p-0 m-2 rounded-full bg-white/[0.60] outline-none transition-colors duration-300 ease-in-out" type="button"></button>'
      )
      .join('');

    dotElements = Array.from(dotsElement.getElementsByTagName('button'));
    dotElements.forEach((dotElement, index) => {
      dotElement.addEventListener(
        'click',
        () => emblaApi.scrollTo(index),
        false
      );
    });
  };

  const toggleDotBtnActive = () => {
    const previous = emblaApi.previousScrollSnap();
    const selected = emblaApi.selectedScrollSnap();
    dotElements[previous].classList.remove('!bg-white');
    dotElements[selected].classList.add('!bg-white');
  };

  emblaApi
    .on('init', addDotBtnsWithClickHandlers)
    .on('reInit', addDotBtnsWithClickHandlers)
    .on('init', toggleDotBtnActive)
    .on('reInit', toggleDotBtnActive)
    .on('select', toggleDotBtnActive);

  return () => {
    dotsElement.innerHTML = '';
  };
};

const removeDotBtnsAndClickHandlers = addDotBtnsAndClickHandlers(
  emblaApi,
  dotsElement
);

emblaApi.on('destroy', removeDotBtnsAndClickHandlers);
