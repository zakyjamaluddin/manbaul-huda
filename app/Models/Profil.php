<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $casts = [
        'misi' => 'array',
    ];
    protected $guarded = [];

    public function kaldikBlog()
    {
        return $this->belongsTo(Blog::class, 'kaldik_blog_id');
    }

    public function programUnggulanBlog()
    {
        return $this->belongsTo(Blog::class, 'program_unggulan_blog_id');
    }

    public function ekstrakurikulerBlog()
    {
        return $this->belongsTo(Blog::class, 'ekstrakurikuler_blog_id');
    }

}
