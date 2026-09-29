<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'tanggal_publikasi',
        'gambar',
        'deskripsi',
        'is_featured',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Bikin slug otomatis dari judul saat artikel dibuat/diupdate.
     */
    protected static function booted(): void
    {
        static::saving(function (Artikel $artikel) {
            if (empty($artikel->slug) || $artikel->isDirty('judul')) {
                $base = Str::slug($artikel->judul);
                $slug = $base;
                $i = 1;

                while (
                    static::where('slug', $slug)
                        ->when($artikel->exists, fn ($q) => $q->where('id', '!=', $artikel->id))
                        ->exists()
                ) {
                    $slug = $base . '-' . $i++;
                }

                $artikel->slug = $slug;
            }
        });
    }

    /**
     * Excerpt singkat dari deskripsi (buat ditampilkan di tabel admin / kartu publik).
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->deskripsi), 100);
    }

    /**
     * URL gambar lengkap (fallback ke placeholder kalau belum ada gambar).
     */
    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : asset('images/artikel/placeholder.png');
    }
}