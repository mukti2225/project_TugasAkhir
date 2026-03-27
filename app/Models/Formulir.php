<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Formulir extends Model
{
    /** @use HasFactory<\Database\Factories\FormulirFactory> */
    use HasFactory;
    
    protected $table = 'formulirs'; 

    protected $fillable = [
        // USER ID
        'user_id',

        // DATA PRIBADI
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'jenis_kelamin',
        'agama',
        'program_studi',
        'anak',
        'status',

        // TEMPAT TINGGAL
        'alamat',
        'jalan',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'nomor_telepon',
        'nomor_telepon_siswa',
        'tinggal',
        'jarak_sekolah',

        // PENDIDIKAN
        'pendidikan',
        'nisn',
        'ijazah',
        'asal_sekolah',
        'pindahan',

        // AYAH
        'nama_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'agama_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'alamat_ayah',
        'nomor_telepon_ayah',

        // IBU
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'agama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'alamat_ibu',
        'nomor_telepon_ibu',

        // WALI
        'nama_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'agama_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'alamat_wali',
        'nomor_telepon_wali',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_lahir_ayah' => 'date',
        'tanggal_lahir_ibu' => 'date',
        'tanggal_lahir_wali' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
