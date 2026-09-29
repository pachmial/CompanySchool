@extends('layouts.app')

@section('title', 'SMKN 4 Kota Bogor - Galeri')

@push('styles')
    @vite('resources/css/galeri.css')
@endpush

@section('content')

    {{-- ============================= BANNER HALAMAN ============================= --}}
    <section class="page-banner page-banner--center">
        <div class="page-banner__content">
            <h1 class="page-banner__title">Galeri Sekolah</h1>
            <p class="page-banner__subtitle">
                Dokumentasi visual berbagai kegiatan, prestasi, dan fasilitas unggulan di SMKN 4 Kota Bogor.
            </p>
            <nav class="breadcrumb breadcrumb--center" aria-label="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb__link">Home</a>
                <span class="breadcrumb__sep">&rsaquo;</span>
                <span class="breadcrumb__current">Galeri</span>
            </nav>
        </div>
    </section>

    {{-- ============================= KONTEN GALERI ============================= --}}
    <section class="galeri-section">
        <div class="galeri-container">

            {{-- Filter Kategori --}}
            <div class="gallery-filter">
                <a href="{{ route('galeri') }}" class="gallery-filter__btn {{ $kategoriAktif === 'semua' ? 'gallery-filter__btn--active' : '' }}">Semua</a>
                <a href="{{ route('galeri', ['kategori' => 'prestasi']) }}" class="gallery-filter__btn {{ $kategoriAktif === 'prestasi' ? 'gallery-filter__btn--active' : '' }}">Prestasi</a>
                <a href="{{ route('galeri', ['kategori' => 'kegiatan']) }}" class="gallery-filter__btn {{ $kategoriAktif === 'kegiatan' ? 'gallery-filter__btn--active' : '' }}">Kegiatan</a>
                <a href="{{ route('galeri', ['kategori' => 'fasilitas']) }}" class="gallery-filter__btn {{ $kategoriAktif === 'fasilitas' ? 'gallery-filter__btn--active' : '' }}">Fasilitas</a>
            </div>

            {{-- Grid Galeri (dinamis) --}}
            <div class="gallery-grid-3col">
                @forelse ($galeris as $galeri)
                    <div class="gallery-tile">
                        <img src="{{ $galeri->foto_url }}" alt="{{ $galeri->judul_kegiatan }}" class="gallery-tile__image">
                    </div>
                @empty
                    <p class="gallery-empty">Belum ada foto di kategori ini.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            @include('admin.partials.pagination', ['paginator' => $galeris])

        </div>
    </section>

@endsection