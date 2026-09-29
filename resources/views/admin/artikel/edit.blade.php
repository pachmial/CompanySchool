@extends('admin.layouts.app')

@section('title', 'Edit Artikel - Admin SMKN 4 Kota Bogor')
@section('page-title', 'Edit Artikel')

@push('styles')
    @vite('resources/css/admin-artikel.css')
@endpush

@section('content')

    <div class="artikel-form-header">
        <div>
            <h1 class="artikel-form-title">Informasi Artikel</h1>
            <p class="artikel-form-subtitle">Perbarui detail artikel di bawah ini.</p>
        </div>
        <div class="artikel-form-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">DASHBOARD</a>
            <span>&rsaquo;</span>
            <a href="{{ route('admin.artikel.index') }}">ARTIKEL</a>
            <span>&rsaquo;</span>
            <span class="artikel-form-breadcrumb__current">EDIT</span>
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
        <form action="{{ route('admin.artikel.update', $article) }}" method="POST" enctype="multipart/form-data" id="artikel-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">JUDUL ARTIKEL</label>
                <input type="text" name="judul" class="form-input" value="{{ old('judul', $article->judul) }}">
            </div>

            <div class="form-group">
                <label class="form-label">TANGGAL PUBLIKASI</label>
                <input type="date" name="tanggal_publikasi" class="form-input" value="{{ old('tanggal_publikasi', $article->tanggal_publikasi->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label class="form-label">GAMBAR</label>
                <label for="gambar-input" class="dropzone" id="dropzone">
                    <img src="{{ asset('images/icons/admin/image-placeholder.svg') }}" alt="" class="dropzone__icon" style="{{ $article->gambar ? 'display:none;' : '' }}">
                    <span class="dropzone__text" style="{{ $article->gambar ? 'display:none;' : '' }}">Klik atau drag gambar ke sini</span>
                    <span class="dropzone__hint" style="{{ $article->gambar ? 'display:none;' : '' }}">PNG, JPG up to 5MB</span>
                    <img id="dropzone-preview" class="dropzone__preview" alt="Preview" src="{{ $article->gambar_url }}" style="{{ $article->gambar ? '' : 'display:none;' }}">
                </label>
                <input type="file" name="gambar" id="gambar-input" accept="image/png, image/jpeg" class="dropzone__input">
                <p class="form-hint">Kosongkan kalau tidak ingin mengganti gambar.</p>
            </div>

            <div class="form-group">
                <label class="form-label">DESKRIPSI</label>
                <div class="rich-editor">
                    <div class="rich-editor__toolbar">
                        <button type="button" data-command="bold"><strong>B</strong></button>
                        <button type="button" data-command="italic"><em>I</em></button>
                        <button type="button" data-command="underline"><u>U</u></button>
                        <span class="rich-editor__divider"></span>
                        <button type="button" data-command="insertUnorderedList">&#8226;&#8226;&#8226;</button>
                        <button type="button" data-command="insertOrderedList">1.2.3</button>
                        <span class="rich-editor__divider"></span>
                        <button type="button" data-command="createLink">&#128279;</button>
                    </div>
                    <div class="rich-editor__content" id="rich-editor-content" contenteditable="true" data-placeholder="Tuliskan berita atau artikel sekolah Anda di sini...">{!! old('deskripsi', $article->deskripsi) !!}</div>
                </div>
                <textarea name="deskripsi" id="deskripsi-input" class="rich-editor__hidden-textarea"></textarea>
            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <button type="submit" class="btn-primary">SIMPAN PERUBAHAN</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
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

        document.getElementById('artikel-form').addEventListener('submit', function () {
            document.getElementById('deskripsi-input').value = document.getElementById('rich-editor-content').innerHTML;
        });
    </script>
@endpush