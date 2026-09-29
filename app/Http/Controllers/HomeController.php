<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Artikel::where('is_featured', true)
            ->latest('tanggal_publikasi')
            ->take(3)
            ->get();

        $produks = Produk::where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        $galeris = Galeri::where('is_featured', true)
            ->latest('tanggal_kegiatan')
            ->take(4)
            ->get();

        return view('home.home', compact('articles', 'produks', 'galeris'));
    }
}