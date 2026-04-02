<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $table = 'ekstrakulikulers';
    
    protected $fillable = [
        'nama',
        'foto',
    ];
}
