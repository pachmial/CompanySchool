@extends('layouts.app')

@section('title', 'SMKN 4 Kota Bogor - Produk')

@push('styles')
    @vite('resources/css/produk.css')
@endpush

@section('content')

    {{-- ============================= BANNER HALAMAN ============================= --}}
    <section class="page-banner produk-banner">
        <div class="page-banner__content">
            <h1 class="page-banner__title">Produk Karya Siswa</h1>
            <p class="page-banner__subtitle">
                Kreativitas tanpa batas dari siswa-siswi SMKN 4 Kota Bogor. Dukung karya lokal berkualitas tinggi mulai dari merchandise hingga kerajinan tangan.
            </p>
        </div>
    </section>

    {{-- ============================= KONTEN PRODUK ============================= --}}
    <section class="produk-section">
        <div class="produk-container">

            {{-- Search Bar (menimpa bagian bawah banner) --}}
            <div class="produk-search">
                <img src="{{ asset('images/artikel/pencarian.png') }}" alt="" class="produk-search__icon">
                <form action="{{ route('produk.index') }}" method="GET" class="produk-search__form">
                    <input
                        type="text"
                        name="q"
                        class="produk-search__input"
                        placeholder="Cari produk..."
                        value="{{ request('q') }}"
                    >
                </form>
            </div>

            {{-- Grid Produk --}}
            <div class="produk-grid">

                @forelse ($produks as $produk)
                    <article class="produk-card">
                        <div class="produk-card__image-wrap">
                            <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama }}" class="produk-card__image">
                        </div>
                        <div class="produk-card__body">
                            <h3 class="produk-card__name">{{ $produk->nama }}</h3>
                            <p class="produk-card__desc">{{ $produk->excerpt }}</p>
                            <div class="produk-card__footer">
                                <span class="produk-card__price">{{ $produk->harga_format }}</span>
                                <a href="{{ route('kontak') }}" class="section-link">Beli disini &rarr;</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="produk-empty">Belum ada produk yang tersedia.</p>
                @endforelse

            </div>

            {{-- Pagination --}}
            @include('admin.partials.pagination', ['paginator' => $produks])

        </div>
    </section>

@endsection