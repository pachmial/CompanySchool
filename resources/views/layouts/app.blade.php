<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMKN 4 Kota Bogor')</title>

    @vite(['resources/css/layout.css', 'resources/js/main.js'])


    @stack('styles')
</head>
<body>

<!-- navbar -->
    <header class="navbar">
        <div class="navbar__container">

            <a href="{{ route('home') }}" class="navbar__brand">
                <img src="{{ asset('images/home/logo.png') }}" alt="Logo SMKN 4 Kota Bogor" class="navbar__logo">
                <span class="navbar__title">SMKN 4 KOTA BOGOR</span>
            </a>

            <nav class="navbar__menu">

                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'is-active' : '' }}">Profil</a>
                <a href="{{ route('artikel.index') }}" class="{{ request()->routeIs('artikel.*') ? 'is-active' : '' }}">Artikel</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'is-active' : '' }}">Galeri</a>
                <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'is-active' : '' }}">Produk</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'is-active' : '' }}">Kontak</a>
            </nav>

            
        </div>
    </header>


    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <footer class="footer">
        <div class="footer__grid">

            <div class="footer__col">
                <h3 class="footer__brand">SMKN 4 KOTA BOGOR</h3>
                <p class="footer__desc">
                    Sekolah menengah kejuruan yang mencetak generasi profesional,
                    berakhlak, dan berprestasi di tingkat internasional.
                </p>
                <div class="footer__social">
                    <a href="https://www.instagram.com/smkn4kotabogor/" aria-label="Instagram"><img src="{{ asset('images/footer/ig.png') }}" alt=""></a>
                    <a href="https://www.youtube.com/@smknegeri4bogor905" aria-label="YouTube"><img src="{{ asset('images/footer/yt.png') }}" alt=""></a>
                    <a href="https://www.tiktok.com/@smkn4kotabogor" aria-label="Tiktok"><img src="{{ asset('images/footer/t.png') }}" alt=""></a>
                </div>
            </div>

            <div class="footer__col">
                <h4 class="footer__heading">JURUSAN</h4>
                <ul class="footer__list">
                    <li>PPLG</li>
                    <li>TJKT</li>
                    <li>TPFL</li>
                    <li>TO</li>
                </ul>
            </div>

            <div class="footer__col">
                <h4 class="footer__heading">INFORMASI</h4>
                <ul class="footer__list footer__list--info">
                    <li>
                        <img src="{{ asset('images/footer/lokasi.png') }}" alt="">
                        Jl. Raya Tajur, Kp. Buntar, Bogor Selatan, Kota Bogor, Jawa Barat
                    </li>
                    <li>
                        <img src="{{ asset('images/footer/telp.png') }}" alt="">
                        (0251) 7547381
                    </li>
                    <li>
                        <img src="{{ asset('images/footer/email.png') }}" alt="">
                        smkn4@smkn4bogor.sch.id
                    </li>
                </ul>
            </div>

            <div class="footer__col">
                <h4 class="footer__heading">JAM OPERASIONAL</h4>
                <ul class="footer__list footer__list--hours">
                    <li><span>Senin - Jumat:</span> <span>06.30 - 17.00 WIB</span></li>
                    <li><span>Sabtu:</span> <span>07.00 - 17.00 WIB</span></li>
                    <li class="is-closed"><span>Minggu:</span> <span>Tutup</span></li>
                </ul>
            </div>
        </div>

        <div class="footer__bottom">
            &copy; {{ date('Y') }} SMKN 4 Kota Bogor. Semua Hak Dilindungi.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>