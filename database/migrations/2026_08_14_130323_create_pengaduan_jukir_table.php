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
        Schema::create('pengaduan_jukir', function (Blueprint $table) {
            $table->integer('id_pengaduan_jukir', true);
            $table->integer('id_juru_parkir');
            $table->string('nama', 50);
            $table->string('nik', 20);
            $table->string('alamat', 150);
            $table->string('nohp', 15);
            $table->string('plat_nomor', 10);
            $table->text('keterangan');
            $table->dateTime('post_time');
            $table->integer('publish')->nullable();
            $table->enum('respon', ['belum', 'sedang', 'sudah'])->nullable();
            $table->string('respon_keterangan', 250)->nullable();
            $table->string('respon_user', 20)->nullable();
            $table->dateTime('respon_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_jukir');
    }
};
