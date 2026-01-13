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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();

            // Relasi ke user login
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // DATA SISWA
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');

            // DATA SEKOLAH ASAL
            $table->string('asal_sekolah');
            $table->string('alamat_sekolah')->nullable();

            // DATA ORANG TUA
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_hp_orang_tua');

            // ALAMAT SISWA
            $table->text('alamat');
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();

            // STATUS PENDAFTARAN
            $table->enum('status', [
                'pending',
                'diverifikasi',
                'diterima',
                'ditolak'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
