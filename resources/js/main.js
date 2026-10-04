document.addEventListener('DOMContentLoaded', function () {

    const toggleBtn = document.querySelector('[data-navbar-toggle]');
    const navMenu = document.querySelector('.navbar__menu');
    const loginBtn = document.querySelector('.btn-login-admin');

    if (!toggleBtn || !navMenu) return;

    function setMenu(open) {
        navMenu.classList.toggle('is-open', open);
        if (loginBtn) loginBtn.classList.toggle('is-open', open);
        toggleBtn.setAttribute('aria-expanded', String(open));
        toggleBtn.setAttribute('aria-label', open ? 'Tutup menu navigasi' : 'Buka menu navigasi');
    }

    toggleBtn.addEventListener('click', function () {
        setMenu(!navMenu.classList.contains('is-open'));
    });

    // Tutup menu saat salah satu link diklik
    navMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () { setMenu(false); });
    });

    // Tutup menu dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') setMenu(false);
    });

    // Reset state saat layar kembali ke ukuran desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) setMenu(false);
    });
});