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
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            // Konten Sambutan
            $table->string('title');

            // Kepala Sekolah
            $table->string('name');
            $table->string('position')->default('Kepala Sekolah');
            $table->string('photo')->nullable();

            // Data Sekolah
            $table->unsignedInteger('total_teachers')->default(0);
            $table->unsignedInteger('total_students')->default(0);
            $table->unsignedInteger('total_classes')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
