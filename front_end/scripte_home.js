document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const body = document.body;

    menuToggle.addEventListener('click', function() {
        body.classList.toggle('menu-open');
    });

    // Fermer le menu lorsqu'un lien est cliqué
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            body.classList.remove('menu-open');
        });
    });
});