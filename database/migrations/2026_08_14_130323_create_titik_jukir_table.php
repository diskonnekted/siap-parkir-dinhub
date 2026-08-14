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
        Schema::create('titik_jukir', function (Blueprint $table) {
            $table->integer('id_titik_jukir', true);
            $table->integer('tahun_pengelolaan');
            $table->integer('id_titik_parkir');
            $table->integer('id_juru_parkir');
            $table->string('qrcode', 10)->nullable();
            $table->string('no_spt', 30)->nullable();
            $table->date('tmt_spt_awal')->nullable();
            $table->date('tmt_spt_akhir')->nullable();
            $table->date('tgl_spt')->nullable();
            $table->integer('setoran_perbulan')->nullable();
            $table->integer('actived');
            $table->dateTime('update_time');
            $table->string('update_user', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titik_jukir');
    }
};
