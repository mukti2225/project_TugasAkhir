<?php

namespace App\Models;

use App\Models\Ptn;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnis';

    protected $fillable = [
        'logo',
        'caption',
    ];

    public function ptn()
    {
        return $this->belongsTo(Ptn::class);
    }
}
