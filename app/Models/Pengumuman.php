<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    /** @use HasFactory<\Database\Factories\PengumumanFactory> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'user_id',
        'thumbnail',
        'file_pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
