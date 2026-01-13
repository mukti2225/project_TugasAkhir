<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
     protected $fillable = [
        'title',
        'image',
        'subtitle',
        'kategori',
        'button_text',
        'button_link',
        'is_active',
        'order'
    ];
}
