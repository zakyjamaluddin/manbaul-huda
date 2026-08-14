<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class KategoriBlog extends Model
{
    protected $table = 'kategori_blogs';
    protected $guarded = ['id'];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'blog_kategori_blog');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });
    }
}
