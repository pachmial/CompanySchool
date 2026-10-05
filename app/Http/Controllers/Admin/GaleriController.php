<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $galeris = Galeri::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('judul_kegiatan', 'like', '%' . $request->q . '%');
            })
            ->latest('tanggal_kegiatan')
            ->paginate(4)
            ->withQueryString();

        $totalFoto = Galeri::count();

        return view('admin.galeri.index', compact('galeris', 'totalFoto'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateGaleri($request);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Diperlukan karena Route::resource mendaftarkan route "show" otomatis.
     */
    public function show(Galeri $galeri)
    {
        return redirect()->route('admin.galeri.edit', $galeri);
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $this->validateGaleri($request, $galeri);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    /**
     * Toggle checkbox "Tampilkan di Beranda" langsung dari daftar galeri.
     */
    public function toggleTampilkan(Galeri $galeri)
    {
        $galeri->update(['is_featured' => ! $galeri->is_featured]);

        return back();
    }

    private function validateGaleri(Request $request, ?Galeri $galeri = null): array
    {
        return $request->validate([
            'judul_kegiatan' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:prestasi,kegiatan,fasilitas'],
            'tanggal_kegiatan' => ['required', 'date'],
            'foto' => [$galeri ? 'nullable' : 'required', 'image', 'max:5120'],
        ], [
            'judul_kegiatan.required' => 'Judul kegiatan wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
            'foto.required' => 'Foto wajib diunggah.',
            'foto.max' => 'Ukuran foto maksimal 5MB.',
        ]);
    }
}