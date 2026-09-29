@extends('layouts.app')

@section('title', 'SMKN 4 Kota Bogor - Kontak')

@push('styles')
    @vite('resources/css/kontak.css')
@endpush

@section('content')

    {{-- ============================= BANNER HALAMAN ============================= --}}
    <section class="page-banner kontak-banner">
        <div class="page-banner__content">
            <h1 class="page-banner__title">Hubungi Kami</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb__link">Home</a>
                <span class="breadcrumb__sep">&rsaquo;</span>
                <span class="breadcrumb__current">Kontak</span>
            </nav>
        </div>
    </section>

    {{-- ============================= KONTEN KONTAK ============================= --}}
    <section class="kontak-section">
        <div class="kontak-container">

            <div class="kontak-grid">

                {{-- Kolom Kiri: Info Sekolah + Jam Operasional --}}
                <div class="kontak-left">
                    <div class="info-card">
                        <h2 class="info-card__title">Informasi Sekolah</h2>

                        <div class="info-item">
                            <span class="info-item__icon">
                                <img src="{{ asset('images/kontak/alamat.png') }}" alt="">
                            </span>
                            <div class="info-item__body">
                                <span class="info-item__label">Alamat</span>
                                <p class="info-item__text">
                                    Jl. Raya Tajur, Kp. Buntar, Bogor Selatan, Kota Bogor, Jawa Barat
                                </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-item__icon">
                                <img src="{{ asset('images/kontak/telp.png') }}" alt="">
                            </span>
                            <div class="info-item__body">
                                <span class="info-item__label">Telepon</span>
                                <p class="info-item__text">(0251) 7547381</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-item__icon">
                                <img src="{{ asset('images/kontak/email.png') }}" alt="">
                            </span>
                            <div class="info-item__body">
                                <span class="info-item__label">Email</span>
                                <p class="info-item__text">smkn4@smkn4bogor.sch.id</p>
                            </div>
                        </div>
                    </div>

                    <div class="jam-card">
                        <h2 class="jam-card__title">
                            <img src="{{ asset('images/kontak/jam.png') }}" alt="" class="jam-card__icon">
                            Jam Operasional
                        </h2>

                        <div class="jam-list">
                            <div class="jam-item">
                                <span class="jam-item__day">Senin - Jumat</span>
                                <span class="jam-item__time">06.30 - 17.00 WIB</span>
                            </div>
                            <div class="jam-item">
                                <span class="jam-item__day">Sabtu</span>
                                <span class="jam-item__time">07.00 - 17.00 WIB</span>
                            </div>
                            <div class="jam-item">
                                <span class="jam-item__day">Minggu</span>
                                <span class="jam-item__time jam-item__time--closed">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Form Kirim Pesan --}}
                <div class="form-card">
                    <h2 class="form-card__title">Kirim Pesan</h2>
                    <p class="form-card__subtitle">Punya pertanyaan? Kirimkan pesan Anda melalui formulir di bawah ini.</p>

                    <form action="#" method="POST" class="kontak-form">
                        @csrf

                        <div class="kontak-form__row">
                            <div class="kontak-form__group">
                                <label for="nama" class="kontak-form__label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="kontak-form__input" placeholder="Masukkan nama">
                            </div>
                            <div class="kontak-form__group">
                                <label for="email" class="kontak-form__label">Email Aktif</label>
                                <input type="email" id="email" name="email" class="kontak-form__input" placeholder="nama@email.com">
                            </div>
                        </div>

                        <div class="kontak-form__group">
                            <label for="subjek" class="kontak-form__label">Subjek</label>
                            <input type="text" id="subjek" name="subjek" class="kontak-form__input" placeholder="Tujuan pesan">
                        </div>

                        <div class="kontak-form__group">
                            <label for="pesan" class="kontak-form__label">Pesan</label>
                            <textarea id="pesan" name="pesan" rows="5" class="kontak-form__textarea" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="kontak-form__submit">
                            KIRIM PESAN
                            <img src="{{ asset('images/kontak/panah.png') }}" alt="" class="kontak-form__submit-icon">
                        </button>
                    </form>
                </div>

            </div>

            {{-- Peta Lokasi --}}
            <div class="kontak-map">
                <div class="kontak-map__badge">
                    <span class="kontak-map__badge-title">Lokasi Kami</span>
                    <p class="kontak-map__badge-text">Temukan kami di Google Maps untuk rute perjalanan terbaik.</p>
                </div>
                <iframe
                    class="kontak-map__frame"
                    src="https://maps.google.com/maps?q=SMK%20Negeri%204%20Kota%20Bogor&t=&z=16&ie=UTF8&iwloc=&output=embed"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi SMKN 4 Kota Bogor">
                </iframe>
            </div>

        </div>
    </section>

@endsection