const burger = document.querySelector('.burger');
const mobileMenu = document.querySelector('.mobile-menu');

burger.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    console.log("Бургер-меню нажато"); // Проверка нажатия
});
