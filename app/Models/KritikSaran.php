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
    ];
}
