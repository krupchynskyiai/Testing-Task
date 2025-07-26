document.addEventListener("DOMContentLoaded", () => {
  const burgerBtn = document.getElementById("burger-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  const paddingY = 32;

  burgerBtn.addEventListener("click", () => {
    const isOpen = mobileMenu.classList.contains("opened");

    if (isOpen) {
      mobileMenu.style.maxHeight = mobileMenu.scrollHeight + paddingY + "px";
      requestAnimationFrame(() => {
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
