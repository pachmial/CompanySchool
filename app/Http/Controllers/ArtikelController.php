<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $articles = Artikel::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->q . '%');
            })
            ->latest('tanggal_publikasi')
            ->paginate(4)
            ->withQueryString();

        return view('artikel.index', compact('articles'));
    }
}