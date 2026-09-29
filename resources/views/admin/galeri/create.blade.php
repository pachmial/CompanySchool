@extends('admin.layouts.app')

@section('title', 'Tambah Galeri - Admin SMKN 4 Kota Bogor')
@section('page-title', 'Admin Panel')

@push('styles')
    @vite('resources/css/admin-galeri.css')
@endpush

@section('content')

    <nav class="galeri-breadcrumb">
        <a href="{{ route('admin.galeri.index') }}">Galeri</a>
        <span>&rsaquo;</span>
        <span class="galeri-breadcrumb__current">Tambah Galeri</span>
    </nav>

    <div class="galeri-form-header">
        <h1 class="galeri-form-title">Informasi Galeri</h1>
        <p class="galeri-form-subtitle">Tambahkan dokumentasi kegiatan terbaru sekolah.</p>
    </div>

    @if ($errors->any())
        <div class="admin-alert admin-alert--error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="galeri-form-card">
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="judul_kegiatan">Judul Kegiatan</label>
                <input type="text" id="judul_kegiatan" name="judul_kegiatan" class="form-input" placeholder="Contoh: Lomba Kompetensi Siswa 2024" value="{{ old('judul_kegiatan') }}">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="kategori">Kategori</label>
                    <select id="kategori" name="kategori" class="form-input form-select">
                        <option value="prestasi" @selected(old('kategori') === 'prestasi')>Prestasi</option>
                        <option value="kegiatan" @selected(old('kategori', 'kegiatan') === 'kegiatan')>Kegiatan</option>
                        <option value="fasilitas" @selected(old('kategori') === 'fasilitas')>Fasilitas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tanggal_kegiatan">Tanggal Kegiatan</label>
                    <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" class="form-input" value="{{ old('tanggal_kegiatan') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Galeri</label>
                <label for="foto-input" class="dropzone">
                    <span class="dropzone__icon-wrap">
                        <img src="{{ asset('images/icons/admin/upload.svg') }}" alt="" class="dropzone__icon">
                    </span>
                    <span class="dropzone__text">Klik atau seret foto ke sini</span>
                    <span class="dropzone__hint">Maksimal ukuran file 5MB. Format yang didukung: JPG, PNG, WEBP.</span>
                    <img id="dropzone-preview" class="dropzone__preview" style="display:none;" alt="Preview">
                </label>
                <input type="file" name="foto" id="foto-input" accept="image/png, image/jpeg, image/webp" class="dropzone__input">
            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <button type="submit" class="btn-primary">Terbitkan Galeri</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        const fotoInput = document.getElementById('foto-input');
        const dropzonePreview = document.getElementById('dropzone-preview');
        const dropzoneIconWrap = document.querySelector('.dropzone__icon-wrap');
        const dropzoneText = document.querySelector('.dropzone__text');
        const dropzoneHint = document.querySelector('.dropzone__hint');

        fotoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                dropzonePreview.src = e.target.result;
                dropzonePreview.style.display = 'block';
                dropzoneIconWrap.style.display = 'none';
                dropzoneText.style.display = 'none';
                dropzoneHint.style.display = 'none';
            };
            reader.readAsDataURL(file);
        });
    </script>
@endpush