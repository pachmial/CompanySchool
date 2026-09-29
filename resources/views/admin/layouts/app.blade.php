<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - SMKN 4 Kota Bogor')</title>

    @vite(['resources/css/app.css', 'resources/css/layout.css'])
    @vite('resources/css/admin.css')
    @stack('styles')
</head>
<body class="admin-body">

    <div class="admin-layout">

        <aside class="admin-sidebar">
            <div class="admin-sidebar__brand">
                <h1 class="admin-sidebar__brand-title">SMKN 4 BOGOR</h1>
                <p class="admin-sidebar__brand-subtitle">Administrator</p>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav__item {{ request()->routeIs('admin.dashboard') ? 'admin-nav__item--active' : '' }}">
                    <img src="{{ asset('images/dbadmin/db.png') }}" alt="" class="admin-nav__icon">
                    Dashboard
                </a>
                <a href="{{ route('admin.artikel.index') }}" class="admin-nav__item {{ request()->routeIs('admin.artikel.*') ? 'admin-nav__item--active' : '' }}">
                    <img src="{{ asset('images/dbadmin/kertas2.png') }}" alt="" class="admin-nav__icon">
                    Artikel
                </a>
                <a href="{{ route('admin.produk.index') }}" class="admin-nav__item {{ request()->routeIs('admin.produk.*') ? 'admin-nav__item--active' : '' }}">
                    <img src="{{ asset('images/dbadmin/tas2.png') }}" alt="" class="admin-nav__icon">
                    Produk
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="admin-nav__item {{ request()->routeIs('admin.galeri.*') ? 'admin-nav__item--active' : '' }}">
                    <img src="{{ asset('images/dbadmin/galeri2.png') }}" alt="" class="admin-nav__icon">
                    Galeri
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" class="admin-nav__logout-form">
                    @csrf
                    <button type="submit" class="admin-nav__item admin-nav__item--logout">
                        <img src="{{ asset('images/dbadmin/lg.png') }}" alt="" class="admin-nav__icon">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <h2 class="admin-topbar__title">@yield('page-title', 'Dashboard Overview')</h2>
            </header>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>

    </div>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>