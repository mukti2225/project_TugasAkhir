<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'user_id',
        'deskripsi',
        'file_pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
