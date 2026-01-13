<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\KategoriArtikel;

class Artikel extends Model
{
    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'thumbnail',
        'user_id',
        'kategori_artikel_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function kategoriArtikel()
    {
    	return $this->belongsTo(KategoriArtikel::class);
    }
}
