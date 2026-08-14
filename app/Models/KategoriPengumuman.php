<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class KategoriPengumuman extends Model
{
    protected $table = 'kategori_pengumumans';
    protected $guarded = ['id'];

    public function pengumumans(): BelongsToMany
    {
        return $this->belongsToMany(Pengumuman::class, 'pengumuman_kategori_pengumuman');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });
    }
}
