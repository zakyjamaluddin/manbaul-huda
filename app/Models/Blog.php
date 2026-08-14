<?php

namespace App\Models;

use App\Models\KategoriBlog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $guarded = [];

    public function kategoris(): BelongsToMany
    {
        return $this->belongsToMany(KategoriBlog::class, 'blog_kategori_blog');
    }

    // Relasi Pivot Banyak ke Banyak (Many-to-Many)

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($blog) {
            // Slug dibuat otomatis di balik layar dari judul
            $blog->slug = Str::slug($blog->judul);
            
            // 1. Otomatis buatkan slug jika slug kosong
            if (empty($blog->slug) && !empty($blog->judul)) {
                $blog->slug = Str::slug($blog->judul);
            }

            // 2. Aturan: Jika disematkan = true, lepas sematan pada artikel lainnya
            if ($blog->is_disematkan) {
                static::where('id', '!=', $blog->id)
                    ->where('is_disematkan', true)
                    ->update(['is_disematkan' => false]);
            }
        });
    }

    protected $casts = [
        'kategori' => 'array',
        'is_disematkan' => 'boolean',
    ];
}
