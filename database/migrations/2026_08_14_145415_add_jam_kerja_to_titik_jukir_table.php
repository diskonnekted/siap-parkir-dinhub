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
        Schema::table('titik_jukir', function (Blueprint $table) {
            $table->string('jam_kerja_awal', 20)->nullable()->after('id_juru_parkir');
            $table->string('jam_kerja_akhir', 20)->nullable()->after('jam_kerja_awal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('titik_jukir', function (Blueprint $table) {
            $table->dropColumn(['jam_kerja_awal', 'jam_kerja_akhir']);
        });
    }
};
