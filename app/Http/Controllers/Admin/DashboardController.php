<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArtikel = Artikel::count();
        $totalProduk = Produk::count();
        $totalGaleri = Galeri::count();

        return view('admin.dashboard', compact('totalArtikel', 'totalProduk', 'totalGaleri'));
    }
}