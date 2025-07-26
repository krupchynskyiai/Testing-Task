/******/ (() => { // webpackBootstrap
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
document.addEventListener("DOMContentLoaded", function () {
  var burgerBtn = document.getElementById("burger-btn");
  var mobileMenu = document.getElementById("mobile-menu");
  var paddingY = 32;
  burgerBtn.addEventListener("click", function () {
    var isOpen = mobileMenu.classList.contains("opened");
    if (isOpen) {
      mobileMenu.style.maxHeight = mobileMenu.scrollHeight + paddingY + "px";
      requestAnimationFrame(function () {
        mobileMenu.style.maxHeight = "0px";
        mobileMenu.style.paddingTop = "0px";
        mobileMenu.style.paddingBottom = "0px";
      });
    } else {
      mobileMenu.style.paddingTop = "16px";
      mobileMenu.style.paddingBottom = "16px";
      mobileMenu.style.maxHeight = mobileMenu.scrollHeight + paddingY + "px";
    }
    mobileMenu.classList.toggle("opened");
  });
});
/******/ })()
;
//# sourceMappingURL=main.js.map