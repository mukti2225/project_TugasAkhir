<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Berkas extends Model
{
    /** @use HasFactory<\Database\Factories\BerkasFactory> */
    use HasFactory;
    protected $table = 'berkas'; 

    protected $fillable = [
        // USER ID
        'user_id',
        'akta_kelahiran',
        'kartu_keluarga',
        'ijazah',
        'prestasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
