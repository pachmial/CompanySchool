<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'harga',
        'gambar',
        'deskripsi',
        'is_featured',
    ];

    protected $casts = [
        'harga' => 'integer',
        'is_featured' => 'boolean',
    ];


    protected static function booted(): void
    {
        static::saving(function (Produk $produk) {
            if (empty($produk->slug) || $produk->isDirty('nama')) {
                $base = Str::slug($produk->nama);
                $slug = $base;
                $i = 1;

                while (
                    static::where('slug', $slug)
                        ->when($produk->exists, fn ($q) => $q->where('id', '!=', $produk->id))
                        ->exists()
                ) {
                    $slug = $base . '-' . $i++;
                }

                $produk->slug = $slug;
            }
        });
    }


    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->deskripsi), 60);
    }


    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : asset('images/produk/placeholder.png');
    }
}