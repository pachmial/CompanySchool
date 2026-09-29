<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->q . '%');
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('produk.index', compact('produks'));
    }
}