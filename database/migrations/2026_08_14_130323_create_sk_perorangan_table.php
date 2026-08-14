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
        Schema::create('sk_perorangan', function (Blueprint $table) {
            $table->integer('id_sk_perorangan', true);
            $table->integer('id_pengelola_perorangan');
            $table->integer('tahun_pengelolaan');
            $table->string('jenis_lokasi', 50)->nullable();
            $table->string('nama_lokasi', 50)->nullable();
            $table->string('zona', 10)->nullable();
            $table->string('no_sk', 30);
            $table->string('hari_sk', 10);
            $table->date('tgl_sk');
            $table->integer('retribusi_perbulan')->nullable();
            $table->bigInteger('retribusi_pertahun')->nullable();
            $table->integer('printed')->nullable();
            $table->string('update_user', 20)->nullable();
            $table->dateTime('update_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_perorangan');
    }
};
