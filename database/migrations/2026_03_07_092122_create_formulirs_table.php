<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formulirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            
            //KETERANGAN DATA PRIBADI
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('anak');
            $table->string('status');

            //KETERANGAN TEMPAT TINGGAL
            $table->text('alamat');
            $table->string('jalan');
            $table->string('rt_rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('nomor_telepon')->nullable();
            $table->string('nomor_telepon_siswa')->nullable();
            $table->string('tinggal');
            $table->string('jarak_sekolah');

            //KETERANGAN PENDIDIKAN SEBELUMNYA
            $table->string('pendidikan');
            $table->string('nisn')->unique();
            $table->string('ijazah');
            $table->string('asal_sekolah');
            $table->string('pindahan')->nullable();
             $table->string('program_studi');

            //KETERANGAN AYAH
            $table->string('nama_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('agama_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->text('alamat_ayah')->nullable();
            $table->string('nomor_telepon_ayah')->nullable();

            //KETERANGAN IBU
            $table->string('nama_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->text('alamat_ibu')->nullable();
            $table->string('nomor_telepon_ibu')->nullable();

            //KETERANGAN WALI
            $table->string('nama_wali')->nullable();
            $table->string('tempat_lahir_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('agama_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('nomor_telepon_wali')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulirs');
    }
};
