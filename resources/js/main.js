document.addEventListener('DOMContentLoaded', function () {

    const toggleBtn = document.querySelector('[data-navbar-toggle]');
    const navMenu = document.querySelector('.navbar__menu');
    const loginBtn = document.querySelector('.btn-login-admin');

    if (toggleBtn && navMenu) {
        toggleBtn.addEventListener('click', function () {

            navMenu.classList.toggle('is-open');
            if (loginBtn) {
                loginBtn.classList.toggle('is-open');
            }
        });
    }
});