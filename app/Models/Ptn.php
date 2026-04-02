<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ptn extends Model
{
    protected $fillable = [
        'nama',
        'universitas',
        'foto',
        'logo',
    ];

    public function alumni()
    {
        return $this->hasMany(Alumni::class);
    }
}
