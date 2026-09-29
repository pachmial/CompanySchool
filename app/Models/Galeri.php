<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_kegiatan',
        'kategori',
        'slug',
        'tanggal_kegiatan',
        'foto',
        'is_featured',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Bikin slug otomatis dari judul kegiatan saat dibuat/diupdate.
     */
    protected static function booted(): void
    {
        static::saving(function (Galeri $galeri) {
            if (empty($galeri->slug) || $galeri->isDirty('judul_kegiatan')) {
                $base = Str::slug($galeri->judul_kegiatan);
                $slug = $base;
                $i = 1;

                while (
                    static::where('slug', $slug)
                        ->when($galeri->exists, fn ($q) => $q->where('id', '!=', $galeri->id))
                        ->exists()
                ) {
                    $slug = $base . '-' . $i++;
                }

                $galeri->slug = $slug;
            }
        });
    }

    /**
     * Label kategori buat ditampilkan (huruf besar di awal).
     */
    public function getKategoriLabelAttribute(): string
    {
        return ucfirst($this->kategori);
    }

    /**
     * URL foto lengkap (fallback ke placeholder kalau belum ada foto).
     */
    public function getFotoUrlAttribute(): string
    {
        return $this->foto
            ? asset('storage/' . $this->foto)
            : asset('images/galeri/placeholder.png');
    }
}