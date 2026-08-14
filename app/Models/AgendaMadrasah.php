<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaMadrasah extends Model
{
    protected $table = 'agenda_madrasahs';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];
}
