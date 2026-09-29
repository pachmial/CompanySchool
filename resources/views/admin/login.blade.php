@extends('admin.layouts.auth')

@section('title', 'Login Admin - SMKN 4 Kota Bogor')

@push('styles')
    @vite('resources/css/login.css')
@endpush

@section('content')

    <div class="login-page">
        <div class="login-card">

            {{-- Panel Brand --}}
            <div class="login-brand">
                <div class="login-brand__logo-wrap">
                    <img src="{{ asset('images/home/logo.png') }}" alt="Logo SMKN 4 Kota Bogor" class="login-brand__logo">
                </div>

                <h1 class="login-brand__title">SMKN 4 KOTA BOGOR</h1>
                <p class="login-brand__text">
                    Sistem Manajemen Informasi Sekolah. Masuk untuk mengelola artikel, produk, galeri, dan data sekolah lainnya dengan aman.
                </p>
            </div>

            {{-- Panel Form --}}
            <div class="login-form-panel">
                <h2 class="login-form-panel__title">Login Admin</h2>
                <p class="login-form-panel__subtitle">Masukkan kredensial Anda untuk mengakses dashboard admin.</p>

                <form action="{{ route('admin.login.attempt') }}" method="POST" class="login-form">
                    @csrf

                    @error('email')
                        <div class="login-error">{{ $message }}</div>
                    @enderror

                    <div class="login-field">
                        <label for="email" class="login-field__label">
                            <img src="{{ asset('images/akeong.png') }}" alt="" class="login-field__label-icon">
                            Email
                        </label>
                        <input type="email" id="email" name="email" class="login-field__input" placeholder="Masukkan email" value="{{ old('email') }}">
                    </div>

                    <div class="login-field">
                        <label for="password" class="login-field__label">
                            <img src="{{ asset('images/sandi.png') }}" alt="" class="login-field__label-icon">
                            Password
                        </label>
                        <div class="login-field__input-wrap">
                            <input type="password" id="password" name="password" class="login-field__input" placeholder="Masukkan password">
                            <button type="button" class="login-field__toggle" aria-label="Tampilkan password" data-toggle-password="password">
                                <img src="{{ asset('images/eye.png') }}" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="login-options">
                        <label class="login-options__remember">
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>
                        <a href="#" class="login-options__forgot">Lupa Password?</a>
                    </div>

                    <button type="submit" class="login-submit">
                        LOGIN ADMIN
                        <img src="{{ asset('images/panah.png') }}" alt="" class="login-submit__icon">
                    </button>
                </form>

                <hr class="login-divider">

                <p class="login-back">
                    Bukan administrator? <a href="{{ route('home') }}" class="login-back__link">Kembali ke Beranda Sekolah</a>
                </p>
            </div>

        </div>

        <p class="login-footer">© {{ date('Y') }} SMKN 4 Kota Bogor. Semua Hak Dilindungi.</p>
    </div>

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.getAttribute('data-toggle-password'));
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });
    </script>
@endpush