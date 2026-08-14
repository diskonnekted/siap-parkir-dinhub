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
        Schema::create('ruas_jalan', function (Blueprint $table) {
            $table->integer('id_ruas_jalan', true);
            $table->enum('status_ruas', ['Nasional', 'Provinsi', 'Kabupaten']);
            $table->string('nomor_ruas', 10);
            $table->string('nama_ruas', 150);
            $table->decimal('panjang', 10);
            $table->decimal('lebar', 10);
            $table->decimal('luas', 10);
            $table->string('titik_awal', 100);
            $table->string('titik_akhir', 100);
            $table->decimal('from_lat', 18, 14);
            $table->decimal('from_lng', 18, 14);
            $table->decimal('to_lat', 18, 14);
            $table->decimal('to_lng', 18, 14);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruas_jalan');
    }
};
