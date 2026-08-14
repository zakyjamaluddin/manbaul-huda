<?php

namespace App\Models;

use App\Models\KategoriPengumuman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    protected $table = 'pengumumans';
    protected $guarded = ['id'];

    protected $casts = [
        'kategori' => 'array',
        'is_disematkan' => 'boolean',
    ];

    public function kategoris(): BelongsToMany
    {
        return $this->belongsToMany(KategoriPengumuman::class, 'pengumuman_kategori_pengumuman');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pengumuman) {
            $pengumuman->slug = Str::slug($pengumuman->judul);
            // Otomatis buat slug dari judul
            if (empty($pengumuman->slug) && !empty($pengumuman->judul)) {
                $pengumuman->slug = Str::slug($pengumuman->judul);
            }

            // Aturan: Jika disematkan = true, lepas sematan dari pengumuman lainnya
            if ($pengumuman->is_disematkan) {
                static::where('id', '!=', $pengumuman->id)
                    ->where('is_disematkan', true)
                    ->update(['is_disematkan' => false]);
            }
        });
    }
}
