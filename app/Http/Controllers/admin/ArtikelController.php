<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.artikel.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateArticle($request);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create($validated);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Diperlukan karena Route::resource mendaftarkan route "show" secara
     * otomatis. Admin tidak punya halaman detail terpisah, jadi cukup
     * arahkan ke halaman edit.
     */
    public function show(Artikel $artikel)
    {
        return redirect()->route('admin.artikel.edit', $artikel);
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', ['article' => $artikel]);
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $this->validateArticle($request, $artikel);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($validated);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Toggle checkbox "Tampilkan di Beranda" langsung dari daftar artikel.
     */
    public function toggleTampilkan(Artikel $artikel)
    {
        $artikel->update(['is_featured' => ! $artikel->is_featured]);

        return back();
    }

    private function validateArticle(Request $request, ?Artikel $artikel = null): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_publikasi' => ['required', 'date'],
            'gambar' => [$artikel ? 'nullable' : 'required', 'image', 'max:5120'],
            'deskripsi' => ['required', 'string'],
        ]);
    }
}