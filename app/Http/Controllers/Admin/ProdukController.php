<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->q . '%');
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();

        $totalProduk = Produk::count();

        return view('admin.produk.index', compact('produks', 'totalProduk'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduk($request);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($validated);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function show(Produk $produk)
    {
        return redirect()->route('admin.produk.edit', $produk);
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $this->validateProduk($request, $produk);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function toggleTampilkan(Produk $produk)
    {
        $produk->update(['is_featured' => ! $produk->is_featured]);

        return back();
    }

    private function validateProduk(Request $request, ?Produk $produk = null): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'gambar' => [$produk ? 'nullable' : 'required', 'image', 'max:2048'],
            'deskripsi' => ['required', 'string'],
        ], [
            'nama.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
            'gambar.required' => 'Gambar produk wajib diunggah.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
        ]);
    }
}