@extends('admin.layouts.app')

@section('title', 'Tambah Produk - Admin SMKN 4 Kota Bogor')
@section('page-title', 'Tambah Produk')

@push('styles')
    @vite('resources/css/admin-produk.css')
@endpush

@section('content')

    <nav class="produk-breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span>&rsaquo;</span>
        <a href="{{ route('admin.produk.index') }}">Produk</a>
        <span>&rsaquo;</span>
        <span class="produk-breadcrumb__current">Tambah Produk</span>
    </nav>

    <div class="produk-form-header">
        <h1 class="produk-form-title">Informasi Produk</h1>
        <p class="produk-form-subtitle">Lengkapi detail di bawah ini untuk menambahkan produk baru ke katalog sekolah.</p>
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

    <div class="produk-form-card">
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" id="produk-form">
            @csrf

            <div class="form-group">
                <label class="form-label" for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="form-input" placeholder="Contoh: Seragam Batik Sekolah" value="{{ old('nama') }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="harga">Harga</label>
                <div class="input-prefix">
                    <span class="input-prefix__label">Rp</span>
                    <input type="number" id="harga" name="harga" class="form-input" placeholder="0" min="0" value="{{ old('harga') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Produk</label>
                <div class="rich-editor">

                    <div class="rich-editor__content" id="rich-editor-content" contenteditable="true" data-placeholder="Tuliskan detail produk, spesifikasi, dan ukuran...">{!! old('deskripsi') !!}</div>
                </div>
                <textarea name="deskripsi" id="deskripsi-input" class="rich-editor__hidden-textarea"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Produk</label>
                <label for="gambar-input" class="dropzone">
                    <span class="dropzone__icon-wrap">
                        <img src="{{ asset('images/icons/admin/upload.svg') }}" alt="" class="dropzone__icon">
                    </span>
                    <span class="dropzone__text">Klik atau seret gambar ke sini</span>
                    <span class="dropzone__hint">Format JPG, PNG atau WEBP (Maks. 2MB)</span>
                    <img id="dropzone-preview" class="dropzone__preview" style="display:none;" alt="Preview">
                </label>
                <input type="file" name="gambar" id="gambar-input" accept="image/png, image/jpeg, image/webp" class="dropzone__input">
            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <button type="submit" class="btn-primary">Terbitkan Produk</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        const gambarInput = document.getElementById('gambar-input');
        const dropzonePreview = document.getElementById('dropzone-preview');
        const dropzoneIconWrap = document.querySelector('.dropzone__icon-wrap');
        const dropzoneText = document.querySelector('.dropzone__text');
        const dropzoneHint = document.querySelector('.dropzone__hint');

        gambarInput.addEventListener('change', function () {
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

        document.querySelectorAll('.rich-editor__toolbar button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const command = btn.getAttribute('data-command');
                if (command === 'createLink') {
                    const url = prompt('Masukkan URL:');
                    if (url) document.execCommand(command, false, url);
                } else {
                    document.execCommand(command, false, null);
                }
                document.getElementById('rich-editor-content').focus();
            });
        });

        document.getElementById('produk-form').addEventListener('submit', function () {
            document.getElementById('deskripsi-input').value = document.getElementById('rich-editor-content').innerHTML;
        });
    </script>
@endpush