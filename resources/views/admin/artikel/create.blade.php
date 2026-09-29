@extends('admin.layouts.app')

@section('title', 'Tambah Artikel - Admin SMKN 4 Kota Bogor')
@section('page-title', 'Tambah Artikel Baru')

@push('styles')
    @vite('resources/css/admin-artikel.css')
@endpush

@section('content')

    <div class="artikel-form-header">
        <div>
            <h1 class="artikel-form-title">Informasi Artikel</h1>
            <p class="artikel-form-subtitle">Lengkapi detail di bawah ini untuk menerbitkan artikel baru.</p>
        </div>
        <div class="artikel-form-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">DASHBOARD</a>
            <span>&rsaquo;</span>
            <a href="{{ route('admin.artikel.index') }}">ARTIKEL</a>
            <span>&rsaquo;</span>
            <span class="artikel-form-breadcrumb__current">BARU</span>
        </div>
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

    <div class="artikel-form-card">
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" id="artikel-form">
            @csrf

            <div class="form-group">
                <label class="form-label">JUDUL ARTIKEL</label>
                <input type="text" name="judul" class="form-input" placeholder="Masukkan judul artikel yang menarik..." value="{{ old('judul') }}">
            </div>

            <div class="form-group">
                <label class="form-label">TANGGAL PUBLIKASI</label>
                <input type="date" name="tanggal_publikasi" class="form-input" value="{{ old('tanggal_publikasi') }}">
            </div>

            <div class="form-group">
                <label class="form-label">GAMBAR</label>
                <label for="gambar-input" class="dropzone" id="dropzone">
                    <img src="{{ asset('images/dbadmin/galeri2.png') }}" alt="" class="dropzone__icon">
                    <span class="dropzone__text">Klik atau drag gambar ke sini</span>
                    <span class="dropzone__hint">PNG, JPG up to 5MB</span>
                    <img id="dropzone-preview" class="dropzone__preview" style="display:none;" alt="Preview">
                </label>
                <input type="file" name="gambar" id="gambar-input" accept="image/png, image/jpeg" class="dropzone__input">
            </div>

            <div class="form-group">
                <label class="form-label">DESKRIPSI</label>
                <div class="rich-editor">

                    <div class="rich-editor__content" id="rich-editor-content" contenteditable="true" data-placeholder="Tuliskan berita atau artikel sekolah Anda di sini...">{!! old('deskripsi') !!}</div>
                </div>
                <textarea name="deskripsi" id="deskripsi-input" class="rich-editor__hidden-textarea"></textarea>
            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <button type="submit" class="btn-primary">TERBITKAN ARTIKEL</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        // Preview gambar yang dipilih
        const gambarInput = document.getElementById('gambar-input');
        const dropzonePreview = document.getElementById('dropzone-preview');
        const dropzoneIcon = document.querySelector('.dropzone__icon');
        const dropzoneText = document.querySelector('.dropzone__text');
        const dropzoneHint = document.querySelector('.dropzone__hint');

        gambarInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                dropzonePreview.src = e.target.result;
                dropzonePreview.style.display = 'block';
                dropzoneIcon.style.display = 'none';
                dropzoneText.style.display = 'none';
                dropzoneHint.style.display = 'none';
            };
            reader.readAsDataURL(file);
        });

        // Rich text editor sederhana (toolbar dasar)
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

        // Sinkronkan isi rich editor ke textarea tersembunyi sebelum submit
        document.getElementById('artikel-form').addEventListener('submit', function () {
            document.getElementById('deskripsi-input').value = document.getElementById('rich-editor-content').innerHTML;
        });
    </script>
@endpush