function toggleMenu() {
    var navLinks = document.getElementById('nav-links');
    if (navLinks.classList.contains('open')) {
        navLinks.classList.remove('open');
    } else {
        navLinks.classList.add('open');
    }
}

