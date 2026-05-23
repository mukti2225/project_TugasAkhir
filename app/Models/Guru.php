<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'foto',
        'nip',
        'jabatan',
        'status',
        'mata_pelajaran',
        'pendidikan',
        'telepon',
    ];
}
