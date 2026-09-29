@extends('layouts.app')

@section('title', 'SMKN 4 Kota Bogor - Beranda')

@push('styles')
    @vite('resources/css/home.css')
@endpush

@section('content')

    <section class="hero">
        <img src="{{ asset('images/home/lapsmk.png') }}" alt="Lapangan SMKN 4 Kota Bogor" class="hero__bg">
        <div class="hero__overlay"></div>

        <div class="hero__content">
            <h1 class="hero__title">SMKN 4 KOTA BOGOR</h1>
            <p class="hero__subtitle">
                Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi
                dan kejuruan. Siap kerja, santun, mandiri, dan kreatif.
            </p>

            <div class="hero__cta">
                <a href="{{ route('profil') }}" class="btn btn--primary">Lihat Profil</a>
                <a href="{{ route('artikel.index') }}" class="btn btn--outline">Artikel Terbaru</a>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-card__item">
                <img src="{{ asset('images/trio/icon1.png') }}" alt="" class="stats-card__icon">
                <div class="stats-card__number">1000+</div>
                <div class="stats-card__label">SISWA AKTIF</div>
            </div>
            <div class="stats-card__item">
                <img src="{{ asset('images/trio/icon2.png') }}" alt="" class="stats-card__icon">
                <div class="stats-card__number">25+</div>
                <div class="stats-card__label">PRESTASI</div>
            </div>
            <div class="stats-card__item">
                <img src="{{ asset('images/trio/icon3.png') }}" alt="" class="stats-card__icon">
                <div class="stats-card__number">4</div>
                <div class="stats-card__label">JURUSAN</div>
            </div>
        </div>
    </section>

    {{-- ============================= ARTIKEL (DINAMIS) ============================= --}}
    <section class="articles-section">
        <div class="section-header">
            <div>
                <h2 class="section-title">Artikel Terbaru</h2>
                <p class="section-subtitle">Berita dan informasi terkini dari lingkungan sekolah</p>
            </div>
            <a href="{{ route('artikel.index') }}" class="section-link">Lihat Semua &rarr;</a>
        </div>

        <div class="article-grid">
            @forelse ($articles as $article)
                <article class="article-card">
                    <img src="{{ $article->gambar_url }}" alt="{{ $article->judul }}" class="article-card__image">
                    <div class="article-card__body">
                        <span class="article-card__date">{{ $article->tanggal_publikasi->translatedFormat('d F Y') }}</span>
                        <h3 class="article-card__title">{{ $article->judul }}</h3>
                        <p class="article-card__excerpt">{{ $article->excerpt }}</p>
                    </div>
                </article>
            @empty
                <p class="article-empty">Belum ada artikel unggulan. Tandai artikel sebagai "Tampilkan" lewat admin.</p>
            @endforelse
        </div>
    </section>

    {{-- ============================= GALERI + PRODUK ============================= --}}
    <section class="lower-section">
        <div class="lower-grid">

            {{-- Galeri (DINAMIS) --}}
            <div class="gallery-block">
                <div class="section-header section-header--compact">
                    <h2 class="section-title">Galeri Terbaru</h2>
                    <a href="{{ route('galeri') }}" class="section-link">Lihat Semua</a>
                </div>

                <div class="gallery-grid">
                    @forelse ($galeris as $galeri)
                        <img src="{{ $galeri->foto_url }}" alt="{{ $galeri->judul_kegiatan }}" class="gallery-grid__img">
                    @empty
                        <p class="gallery-empty">Belum ada galeri unggulan. Tandai foto sebagai "Tampilkan" lewat admin.</p>
                    @endforelse
                </div>
            </div>

            {{-- Produk (DINAMIS) --}}
            <div class="products-block">
                <div class="section-header section-header--compact">
                    <h2 class="section-title">Produk Unggulan</h2>
                    <a href="{{ route('produk.index') }}" class="section-link">Semua Produk</a>
                </div>

                <div class="product-list">
                    @forelse ($produks as $produk)
                        <div class="product-item">
                            <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama }}" class="product-item__image">
                            <div class="product-item__info">
                                <h4 class="product-item__name">{{ $produk->nama }}</h4>
                                <p class="product-item__desc">{{ $produk->excerpt }}</p>
                                <span class="product-item__price">{{ $produk->harga_format }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="product-empty">Belum ada produk unggulan. Tandai produk sebagai "Tampilkan" lewat admin.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

@endsection