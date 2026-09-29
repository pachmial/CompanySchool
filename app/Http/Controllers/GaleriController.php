<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');

        $galeris = Galeri::query()
            ->when($kategori && $kategori !== 'semua', function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            })
            ->latest('tanggal_kegiatan')
            ->paginate(9)
            ->withQueryString();

        return view('galeri.index', [
            'galeris' => $galeris,
            'kategoriAktif' => $kategori ?: 'semua',
        ]);
    }
}