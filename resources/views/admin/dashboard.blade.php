@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin SMKN 4 Kota Bogor')
@section('page-title', 'Dashboard Overview')

@push('styles')
    @vite('resources/css/admindashboard.css')
@endpush

@section('content')

    <h1 class="dashboard-welcome">Welcome Back, Admin</h1>

    <div class="dashboard-stats">

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--blue">
                <img src="{{ asset('images/dbadmin/kertas.png') }}" alt="">
            </div>
            <div class="stat-card__body">
                <span class="stat-card__label">Total Artikel</span>
                <p class="stat-card__value">
                    <span class="stat-card__number">{{ $totalArtikel }}</span>
                    <span class="stat-card__unit">Artikel</span>
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--amber">
                <img src="{{ asset('images/dbadmin/tas.png') }}" alt="">
            </div>
            <div class="stat-card__body">
                <span class="stat-card__label">Total Produk</span>
                <p class="stat-card__value">
                    <span class="stat-card__number">{{ $totalProduk }}</span>
                    <span class="stat-card__unit">Produk</span>
                </p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--cyan">
                <img src="{{ asset('images/dbadmin/galeri.png') }}" alt="">
            </div>
            <div class="stat-card__body">
                <span class="stat-card__label">Total Galeri</span>
                <p class="stat-card__value">
                    <span class="stat-card__number">{{ $totalGaleri }}</span>
                    <span class="stat-card__unit">Foto</span>
                </p>
            </div>
        </div>

    </div>

@endsection