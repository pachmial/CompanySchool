@extends('admin.layouts.app')

@section('title', 'Kelola Produk - Admin SMKN 4 Kota Bogor')
@section('page-title', 'CRUD Produk')

@push('styles')
    @vite('resources/css/admin-produk.css')
@endpush

@section('content')

    <nav class="produk-breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span>&rsaquo;</span>
        <span class="produk-breadcrumb__current">Produk Unggulan</span>
    </nav>

    <div class="produk-admin-header">
        <div>
            <h1 class="produk-admin-title">Kelola Produk</h1>
            <p class="produk-admin-subtitle">Manajemen inventaris produk sekolah dan atribut siswa.</p>
        </div>

        <a href="{{ route('admin.produk.create') }}" class="btn-primary">
            <span class="btn-primary__plus">+</span> TAMBAH PRODUK
        </a>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
    @endif

    <div class="produk-table-card">
        <div class="produk-table-card__toolbar">
            <form action="{{ route('admin.produk.index') }}" method="GET" class="produk-search">
                <img src="{{ asset('images/artikel/pencarian.png') }}" alt="" class="produk-search__icon">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk...">
            </form>
        </div>

        <table class="produk-table">
            <thead>
                <tr>
                    <th class="col-no">NO.</th>
                    <th class="col-produk">PRODUK</th>
                    <th class="col-harga">HARGA</th>
                    <th class="col-aksi">AKSI</th>
                    <th class="col-tampilkan">TAMPILKAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $index => $produk)
                    <tr>
                        <td class="col-no">{{ $produks->firstItem() + $index }}</td>
                        <td class="col-produk">
                            <div class="produk-table__product-cell">
                                <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama }}" class="produk-table__thumb">
                                <span class="produk-table__name">{{ $produk->nama }}</span>
                            </div>
                        </td>
                        <td class="col-harga">
                            <span class="produk-table__price">{{ $produk->harga_format }}</span>
                        </td>
                        <td class="col-aksi">
                            <div class="produk-table__actions">
                                <a href="{{ route('admin.produk.edit', $produk) }}" class="action-btn action-btn--edit" aria-label="Edit">
                                    <img src="{{ asset('images/edit.png') }}" alt="">
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" onsubmit="return confirm('Yakin mau hapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn--delete" aria-label="Hapus">
                                        <img src="{{ asset('images/hapus.png') }}" alt="">
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="col-tampilkan">
                            <form action="{{ route('admin.produk.toggle', $produk) }}" method="POST" class="toggle-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="toggle-checkbox {{ $produk->is_featured ? 'toggle-checkbox--active' : '' }}" aria-label="Tampilkan di Beranda">
                                    @if ($produk->is_featured)
                                        &#10003;
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="produk-table__empty">Belum ada produk. Klik "Tambah Produk" untuk membuat yang pertama.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($produks->hasPages())
            <div class="produk-table__pagination">
                @include('admin.partials.pagination', ['paginator' => $produks])
            </div>
        @endif
    </div>

@endsection