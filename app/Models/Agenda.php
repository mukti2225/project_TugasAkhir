<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'judul',
        'tanggal',
        'kategori',
        'jam',
        'lokasi',
        'deskripsi',
        'is_active'
    ];
}
