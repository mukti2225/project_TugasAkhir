<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaKependidikan extends Model
{
    protected $table = 'tenaga_kependidikans';
    
    protected $fillable = [
        'nama',
        'foto',
    ];
}
