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
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->text('balasan')->nullable();
            $table->timestamp('dibalas_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->dropColumn([
                'balasan',
                'dibalas_at',
            ]);
        });
    }
};
