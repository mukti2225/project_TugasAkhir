<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nisn',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'alamat_sekolah',
        'nama_ayah',
        'nama_ibu',
        'no_hp_orang_tua',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
