<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'name',
        'position',
        'photo',
        'sambutan',
        'total_teachers',
        'total_students',
        'total_classes',
    ];
}
