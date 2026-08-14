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
        Schema::create('titik_parkir', function (Blueprint $table) {
            $table->integer('id_titik_parkir', true);
            $table->enum('jenis_fasilitas', ['dalam', 'luar']);
            $table->enum('jenis_parkir_luar', ['tkp', 'tpk'])->nullable();
            $table->string('nama_lokasi', 100);
            $table->decimal('panjang_lokasi', 10);
            $table->decimal('lebar_lokasi', 10);
            $table->decimal('luas_lokasi', 10);
            $table->integer('srp_motor')->nullable();
            $table->integer('srp_mobil')->nullable();
            $table->string('id_kecamatan', 10);
            $table->string('id_desa', 10);
            $table->enum('jenis_desa', ['Kelurahan', 'Desa']);
            $table->integer('id_ruas_jalan');
            $table->decimal('titik_lat', 18, 14);
            $table->decimal('titik_lng', 18, 14);
            $table->string('foto_lokasi', 150)->nullable();
            $table->string('data_pendukung', 150)->nullable();
            $table->dateTime('update_time');
            $table->string('update_user', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titik_parkir');
    }
};
