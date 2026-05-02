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
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nomor_pendaftaran')->nullable();
            $table->string('status_penerimaan')->default('Menunggu');

            // DATA SISWA
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->integer('anak')->nullable();
            $table->string('status')->nullable();

            // TEMPAT TINGGAL
            $table->string('nomor_telepon_siswa')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('tinggal')->nullable();
            $table->string('jarak_sekolah')->nullable();
            $table->text('alamat')->nullable();

            // PENDIDIKAN
            $table->string('pendidikan')->nullable();
            $table->string('nisn', 10)->nullable();
            $table->string('ijazah')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('pindahan')->nullable();
            $table->string('program_studi')->nullable();

            // AYAH
            $table->string('nama_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('agama_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->bigInteger('penghasilan_ayah')->nullable();
            $table->string('nomor_telepon_ayah')->nullable();
            $table->text('alamat_ayah')->nullable();

            // IBU
            $table->string('nama_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->bigInteger('penghasilan_ibu')->nullable();
            $table->string('nomor_telepon_ibu')->nullable();
            $table->text('alamat_ibu')->nullable();

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

            //UPLOAD BERKAS
            $table->string('ijazah_file_name')->nullable();
            $table->string('ijazah_file_path')->nullable();

            $table->string('kk_file_name')->nullable();
            $table->string('kk_file_path')->nullable();

            $table->string('akta_file_name')->nullable();
            $table->string('akta_file_path')->nullable();
 
            // ─── Status Verifikasi ───────────────────────────────────────────
            $table->enum('status_verifikasi', ['belum_diverifikasi', 'diverifikasi', 'ditolak'])
                  ->default('belum_diverifikasi');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

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
