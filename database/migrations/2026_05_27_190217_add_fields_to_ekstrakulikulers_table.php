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
        Schema::table('ekstrakulikulers', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('foto');
            $table->text('deskripsi')->nullable()->after('kategori');
            $table->string('jadwal')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekstrakulikulers', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'deskripsi', 'jadwal']);
        });
    }
};
