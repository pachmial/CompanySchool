@extends('layouts.app')

@section('title', 'SMKN 4 Kota Bogor - Profil Sekolah')

@push('styles')
    @vite('resources/css/profil.css')
@endpush

@section('content')

    @include('partials.page-header', [
        'breadcrumb' => 'Profil',
        'title'      => 'Profil Sekolah',
        'subtitle'   => 'Mengenal lebih dekat SMKN 4 Kota Bogor, institusi pendidikan vokasi yang berfokus pada pembentukan generasi yang berprestasi dan berkarakter unggul di era digital.',
    ])

    <section class="profile-section">
        <div class="profile-grid">

            <div class="about-card">
                <h2 class="about-card__title">
                    <img src="{{ asset('images/profil/jam.png') }}" alt="" class="about-card__icon">
                    Tentang Sekolah
                </h2>

                <p class="about-card__text">
                    SMK Negeri 4 Bogor merupakan lembaga pendidikan kejuruan negeri terakreditasi A
                    yang berfokus pada bidang teknologi informasi, rekayasa, pengelasan, dan
                    otomotif. Berdiri sejak tahun 2008, sekolah ini berkomitmen mencetak lulusan siap
                    kerja yang santun, mandiri, kreatif, dan kompetitif di era digital.
                </p>

                <p class="about-card__text">
                    Sekolah ini memiliki lingkungan belajar yang luas dan kondusif, didukung oleh
                    fasilitas praktik modern untuk menunjang kompetensi siswa di setiap bidang
                    keahlian. Melalui sinergi erat bersama berbagai Industri dan Dunia Kerja (IDUKA),
                    SMK Negeri 4 Bogor memastikan kurikulum pembelajaran selalu relevan dengan
                    kebutuhan industri masa kini.
                </p>

                <img src="{{ asset('images/profil/lap2smkn.png') }}" alt="Lingkungan SMKN 4 Kota Bogor" class="about-card__image">
            </div>

            <div class="vision-mission-block">
                <div class="vision-card">
                    <h3 class="vision-card__title">Visi</h3>
                    <p class="vision-card__text">
                        "Terwujudnya sekolah yang tangguh dalam imtaq, terampil, mandiri, berbasis
                        Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan"
                    </p>
                </div>

                <div class="mission-card">
                    <h3 class="mission-card__title">
                        <img src="{{ asset('images/profil/catatan.png') }}" alt="" class="mission-card__icon">
                        Misi
                    </h3>
                    <ul class="mission-card__list">
                        <li>
                            <img src="{{ asset('images/profil/ceklis.png') }}" alt="">
                            Meningkatkan keimanan dan ketakwaan terhadap Tuhan Yang Maha Esa.
                        </li>
                        <li>
                            <img src="{{ asset('images/profil/ceklis.png') }}" alt="">
                            Menyelenggarakan pendidikan dan pelatihan yang kompeten di bidang teknologi dan kejuruan.
                        </li>
                        <li>
                            <img src="{{ asset('images/profil/ceklis.png') }}" alt="">
                            Membentuk peserta didik yang santun, mandiri, kreatif, dan beretos kerja tinggi.
                        </li>
                        <li>
                            <img src="{{ asset('images/profil/ceklis.png') }}" alt="">
                            Mengembangkan sarana prasarana berbasis Teknologi Informasi dan Komunikasi.
                        </li>
                        <li>
                            <img src="{{ asset('images/profil/ceklis.png') }}" alt="">
                            Menciptakan lingkungan sekolah yang bersih, sehat, dan berwawasan lingkungan.
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <section class="facilities-section">
        <div class="facilities-section__inner">
            <h2 class="facilities-section__title">Fasilitas Sekolah</h2>

            <div class="facilities-grid">
                <div class="facility-card">
                    <div class="facility-card__icon">
                        <img src="{{ asset('images/profil/buku.png') }}" alt="">
                    </div>
                    <span class="facility-card__label">Perpustakaan</span>
                </div>

                <div class="facility-card">
                    <div class="facility-card__icon">
                        <img src="{{ asset('images/profil/kotak.png') }}" alt="">
                    </div>
                    <span class="facility-card__label">Lab Komputer</span>
                </div>

                <div class="facility-card">
                    <div class="facility-card__icon">
                        <img src="{{ asset('images/profil/mesjid.png') }}" alt="">
                    </div>
                    <span class="facility-card__label">Masjid</span>
                </div>

                <div class="facility-card">
                    <div class="facility-card__icon">
                        <img src="{{ asset('images/profil/bola.png') }}" alt="">
                    </div>
                    <span class="facility-card__label">Lapangan</span>
                </div>

                <div class="facility-card">
                    <div class="facility-card__icon">
                        <img src="{{ asset('images/profil/p3k.png') }}" alt="">
                    </div>
                    <span class="facility-card__label">UKS</span>
                </div>
            </div>
        </div>
    </section>

@endsection