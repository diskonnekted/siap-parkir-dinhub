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
        Schema::create('juru_parkir', function (Blueprint $table) {
            $table->integer('id_juru_parkir', true);
            $table->integer('id_users');
            $table->string('no_juru_parkir', 6);
            $table->string('nik', 20);
            $table->string('nama', 50);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->string('agama', 20);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->string('id_provinsi', 10);
            $table->string('id_kabupaten', 10);
            $table->string('id_kecamatan', 10);
            $table->string('id_desa', 10);
            $table->text('alamat');
            $table->string('rt', 4);
            $table->string('rw', 4);
            $table->string('domisili_id_provinsi', 10);
            $table->string('domisili_id_kabupaten', 10);
            $table->string('domisili_id_kecamatan', 10);
            $table->string('domisili_id_desa', 10);
            $table->text('domisili_alamat');
            $table->string('domisili_rt', 4);
            $table->string('domisili_rw', 4);
            $table->string('no_telp', 20);
            $table->string('foto', 100);
            $table->string('foto_ktp', 100);
            $table->dateTime('update_time');
            $table->string('update_user', 20);
            $table->integer('verifikasi');
            $table->dateTime('verifikasi_time');
            $table->string('verifikasi_user', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juru_parkir');
    }
};
