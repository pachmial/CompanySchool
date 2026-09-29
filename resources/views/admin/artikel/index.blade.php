@extends('admin.layouts.app')

@section('title', 'Kelola Artikel - Admin SMKN 4 Kota Bogor')
@section('page-title', 'CRUD Artikel')

@push('styles')
    @vite('resources/css/admin-artikel.css')
@endpush

@section('content')

    <div class="artikel-admin-header">
        <div>
            <h1 class="artikel-admin-title">Daftar Artikel</h1>
            <p class="artikel-admin-subtitle">Kelola seluruh konten berita dan artikel sekolah.</p>
        </div>

        <div class="artikel-admin-actions">
            <form action="{{ route('admin.artikel.index') }}" method="GET" class="artikel-admin-search">
                <img src="{{ asset('images/artikel/pencarian.png') }}" alt="" class="artikel-admin-search__icon">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul artikel...">
            </form>

            <a href="{{ route('admin.artikel.create') }}" class="btn-primary">
                <span class="btn-primary__plus">+</span> TAMBAH ARTIKEL
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
    @endif

    <div class="artikel-table-card">
        <table class="artikel-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-judul">JUDUL ARTIKEL</th>
                    <th class="col-deskripsi">DESKRIPSI</th>
                    <th class="col-tanggal">TANGGAL</th>
                    <th class="col-aksi">AKSI</th>
                    <th class="col-tampilkan">TAMPILKAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $index => $article)
                    <tr>
                        <td class="col-no">{{ $articles->firstItem() + $index }}</td>
                        <td class="col-judul">
                            <div class="artikel-table__title-cell">
                                <img src="{{ $article->gambar_url }}" alt="{{ $article->judul }}" class="artikel-table__thumb">
                                <span class="artikel-table__title">{{ $article->judul }}</span>
                            </div>
                        </td>
                        <td class="col-deskripsi">{{ $article->excerpt }}</td>
                        <td class="col-tanggal">{{ $article->tanggal_publikasi->translatedFormat('d F Y') }}</td>
                        <td class="col-aksi">
                            <div class="artikel-table__actions">
                                <a href="{{ route('admin.artikel.edit', $article) }}" class="action-btn action-btn--edit" aria-label="Edit">
                                    <img src="{{ asset('images/edit.png') }}" alt="">
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $article) }}" method="POST" onsubmit="return confirm('Yakin mau hapus artikel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn--delete" aria-label="Hapus">
                                        <img src="{{ asset('images/hapus.png') }}" alt="">
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="col-tampilkan">
                            <form action="{{ route('admin.artikel.toggle', $article) }}" method="POST" class="toggle-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="toggle-checkbox {{ $article->is_featured ? 'toggle-checkbox--active' : '' }}" aria-label="Tampilkan di Beranda">
                                    @if ($article->is_featured)
                                        &#10003;
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="artikel-table__empty">Belum ada artikel. Klik "Tambah Artikel" untuk membuat yang pertama.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($articles->hasPages())
            <div class="artikel-table__pagination">
                @include('admin.partials.pagination', ['paginator' => $articles])
            </div>
        @endif
    </div>

@endsection