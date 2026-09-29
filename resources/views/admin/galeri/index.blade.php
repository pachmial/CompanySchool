@extends('admin.layouts.app')

@section('title', 'Kelola Galeri - Admin SMKN 4 Kota Bogor')
@section('page-title', 'CRUD Galeri')

@push('styles')
    @vite('resources/css/admin-galeri.css')
@endpush

@section('content')

    <div class="galeri-admin-header">
        <div>
            <h1 class="galeri-admin-title">CRUD Galeri</h1>
            <p class="galeri-admin-subtitle">Kelola foto dan dokumentasi kegiatan sekolah di sini.</p>
        </div>

        <a href="{{ route('admin.galeri.create') }}" class="btn-primary">
            <span class="btn-primary__plus">+</span> Tambah Galeri
        </a>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
    @endif

    <div class="galeri-table-card">
        <div class="galeri-table-card__toolbar">
            <h2 class="galeri-table-card__title">Daftar Galeri</h2>
            <form action="{{ route('admin.galeri.index') }}" method="GET" class="galeri-search">
                <img src="{{ asset('images/artikel/pencarian.png') }}" alt="" class="galeri-search__icon">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari galeri...">
            </form>
        </div>

        <table class="galeri-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-foto">FOTO</th>
                    <th class="col-judul">JUDUL KEGIATAN</th>
                    <th class="col-tanggal">TANGGAL</th>
                    <th class="col-kategori">KATEGORI</th>
                    <th class="col-aksi">AKSI</th>
                    <th class="col-tampilkan">TAMPILKAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeris as $index => $galeri)
                    <tr>
                        <td class="col-no">{{ $galeris->firstItem() + $index }}</td>
                        <td class="col-foto">
                            <img src="{{ $galeri->foto_url }}" alt="{{ $galeri->judul_kegiatan }}" class="galeri-table__thumb">
                        </td>
                        <td class="col-judul">
                            <span class="galeri-table__title">{{ $galeri->judul_kegiatan }}</span>
                        </td>
                        <td class="col-tanggal">{{ $galeri->tanggal_kegiatan->translatedFormat('d F Y') }}</td>
                        <td class="col-kategori">{{ $galeri->kategori_label }}</td>
                        <td class="col-aksi">
                            <div class="galeri-table__actions">
                                <a href="{{ route('admin.galeri.edit', $galeri) }}" class="action-btn action-btn--edit" aria-label="Edit">
                                    <img src="{{ asset('images/edit.png') }}" alt="">
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" onsubmit="return confirm('Yakin mau hapus foto ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn--delete" aria-label="Hapus">
                                        <img src="{{ asset('images/hapus.png') }}" alt="">
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="col-tampilkan">
                            <form action="{{ route('admin.galeri.toggle', $galeri) }}" method="POST" class="toggle-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="toggle-checkbox {{ $galeri->is_featured ? 'toggle-checkbox--active' : '' }}" aria-label="Tampilkan di Beranda">
                                    @if ($galeri->is_featured)
                                        &#10003;
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="galeri-table__empty">Belum ada foto. Klik "Tambah Galeri" untuk membuat yang pertama.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($galeris->hasPages())
            <div class="galeri-table__pagination">
                @include('admin.partials.pagination', ['paginator' => $galeris])
            </div>
        @endif
    </div>

@endsection