<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'email',
        'nomor_pendaftaran',
        'status_penerimaan',

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

        // FILE
        'ijazah_file_name',
        'ijazah_file_path',

        'kk_file_name',
        'kk_file_path',

        'akta_file_name',
        'akta_file_path',

        // VERIFIKASI
        'status_verifikasi',
        'catatan_verifikasi',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_lahir_ayah' => 'date',
        'tanggal_lahir_ibu' => 'date',
        'tanggal_lahir_wali' => 'date',
        'verified_at' => 'datetime',

        'penghasilan_ayah' => 'integer',
        'penghasilan_ibu' => 'integer',
        'penghasilan_wali' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    protected static function booted()
    {
        static::creating(function ($data) {
            $data->nomor_pendaftaran = 'SPMB-' . date('Y') . '-' . strtoupper(uniqid());

            // Default status
            $data->status_penerimaan = 'Menunggu';
            $data->status_verifikasi = 'belum_diverifikasi';
        });

        static::created(function ($data) {
            \Mail::to($data->email)->queue(new \App\Mail\PendaftaranSukses($data));
        });
    }
}
