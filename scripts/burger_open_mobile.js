function toggleMenu() {
    var navLinks = document.getElementsByClassName('nav-links')[0]; // Получаем первый элемент
    var content = document.getElementsByClassName('main-content')[0];
    if (navLinks.classList.contains('open')) {
        navLinks.classList.remove('open');
        content.classList.remove('menu-open');
    } else {
        navLinks.classList.add('open');
        content.classList.add('menu-open');
    }
}

