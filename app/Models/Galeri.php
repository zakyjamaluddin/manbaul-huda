<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Galeri extends Model
{
    protected $guarded = ['id'];

    public function kategoris(): BelongsToMany
    {
        return $this->belongsToMany(KategoriGaleri::class, 'galeri_kategori_galeri');
    }

    protected $casts = [
        'kategori' => 'array',
    ];
}
