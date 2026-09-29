@extends('layouts.app')

@section('title', 'SMKN 4 Kota Bogor - Artikel')

@push('styles')
    @vite('resources/css/artikel.css')
@endpush

@section('content')

    <section class="page-banner">
        <div class="page-banner__content">
            <h1 class="page-banner__title">Artikel Terbaru</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb__link">Beranda</a>
                <span class="breadcrumb__sep">&rsaquo;</span>
                <span class="breadcrumb__current">Artikel</span>
            </nav>
        </div>
    </section>

    {{-- ============================= KONTEN ARTIKEL ============================= --}}
    <section class="artikel-section">
        <div class="artikel-layout">

            {{-- Sidebar --}}
            <aside class="artikel-sidebar">
                <div class="search-card">
                    <h2 class="search-card__title">Cari Artikel</h2>
                    <form action="{{ route('artikel.index') }}" method="GET" class="search-card__form">
                        <input
                            type="text"
                            name="q"
                            class="search-card__input"
                            placeholder="Cari..."
                            value="{{ request('q') }}"
                        >
                        <button type="submit" class="search-card__btn" aria-label="Cari">
                            <img src="{{ asset('images/artikel/pencarian.png') }}" alt="" class="search-card__icon">
                        </button>
                    </form>
                </div>
            </aside>

            {{-- Grid Artikel --}}
            <div class="artikel-content">
                <div class="artikel-grid">

                    @forelse ($articles as $article)
                        <article class="artikel-card">
                            <img src="{{ $article->gambar_url }}" alt="{{ $article->judul }}" class="artikel-card__image">
                            <div class="artikel-card__body">
                                <span class="artikel-card__date">
                                    <img src="{{ asset('images/artikel/kalender.png') }}" alt="" class="artikel-card__date-icon">
                                    {{ $article->tanggal_publikasi->translatedFormat('d F Y') }}
                                </span>
                                <h3 class="artikel-card__title">{{ $article->judul }}</h3>
                                <p class="artikel-card__excerpt">{{ $article->excerpt }}</p>
                                <hr class="artikel-card__divider">
                            </div>
                        </article>
                    @empty
                        <p class="artikel-empty">Belum ada artikel yang dipublikasikan.</p>
                    @endforelse

                </div>

                {{-- Pagination --}}
                @include('admin.partials.pagination', ['paginator' => $articles])
            </div>

        </div>
    </section>

@endsection