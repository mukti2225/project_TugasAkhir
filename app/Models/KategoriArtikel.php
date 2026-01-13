<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    protected $table = 'kategori_artikels';

    protected $fillable = [
    	'nama_kategori','slug',
    ];

    public function artikel()
    {
    	return $this->hasMany(Artikel::class,'kategori_artikel_id');
    }
}
