import Swiper from "swiper";
import { Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

const swiperHero = new Swiper(".hero__swiper", {
  slidesPerView: 1,
  loop: true,
});

const swiperList = new Swiper(".list__swiper", {
  modules: [Autoplay],
  slidesPerView: 3,
  spaceBetween: 24,
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1
    },
    768: {
      slidesPerView: 2,
    },
    1440: {
      slidesPerView: 3,
    },
  }
});
