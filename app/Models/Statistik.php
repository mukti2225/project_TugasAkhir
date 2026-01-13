<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $fillable = [
        'title',
        'name',
        'position',
        'photo',
        'total_teachers',
        'total_students',
        'total_classes',
    ];
}
