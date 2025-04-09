document.addEventListener('DOMContentLoaded', () => {
    const userMenu = document.querySelector('.user-menu');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    // Открываем и закрываем меню при клике
    userMenu.addEventListener('click', (e) => {
        e.stopPropagation(); // предотвращаем всплытие события
        dropdownMenu.classList.toggle('active');
    });

    // Закрываем меню при клике вне меню
    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target)) {
            dropdownMenu.classList.remove('active');
        }
    });
});
