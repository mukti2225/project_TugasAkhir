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
            $table->foreignId('user_id')->constrained();

            // DATA SISWA
            $table->string('nama');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->integer('anak');
            $table->string('status');

            // TEMPAT TINGGAL
            $table->string('nomor_telepon_siswa');
            $table->string('nomor_telepon')->nullable();
            $table->string('tinggal');
            $table->string('jarak_sekolah');
            $table->text('alamat');

            // PENDIDIKAN
            $table->string('pendidikan');
            $table->string('nisn', 10);
            $table->string('ijazah');
            $table->string('asal_sekolah');
            $table->string('pindahan')->nullable();
            $table->string('program_studi');

            // AYAH
            $table->string('nama_ayah');
            $table->string('tempat_lahir_ayah');
            $table->date('tanggal_lahir_ayah');
            $table->string('agama_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->bigInteger('penghasilan_ayah');
            $table->string('nomor_telepon_ayah');
            $table->text('alamat_ayah');

            // IBU
            $table->string('nama_ibu');
            $table->string('tempat_lahir_ibu');
            $table->date('tanggal_lahir_ibu');
            $table->string('agama_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->bigInteger('penghasilan_ibu');
            $table->string('nomor_telepon_ibu');
            $table->text('alamat_ibu');

            // WALI
            $table->string('nama_wali')->nullable();
            $table->string('tempat_lahir_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('agama_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->bigInteger('penghasilan_wali')->nullable();
            $table->string('nomor_telepon_wali')->nullable();
            $table->text('alamat_wali')->nullable();

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
