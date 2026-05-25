<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'balasan',
        'dibalas_at',
    ];

    protected $casts = [
        'dibalas_at' => 'datetime',
    ];
}
