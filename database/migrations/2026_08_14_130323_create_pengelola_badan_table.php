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
        Schema::create('pengelola_badan', function (Blueprint $table) {
            $table->integer('id_pengelola_badan', true);
            $table->integer('id_users');
            $table->string('nama_badan', 50);
            $table->string('id_provinsi', 10);
            $table->string('id_kabupaten', 10);
            $table->string('id_kecamatan', 10);
            $table->string('id_desa', 10);
            $table->text('alamat');
            $table->string('rt', 4);
            $table->string('rw', 4);
            $table->string('no_telp', 20);
            $table->string('email', 20);
            $table->string('nib', 30);
            $table->string('foto_nib', 150)->nullable();
            $table->string('no_akta', 30)->nullable();
            $table->date('tgl_akta')->nullable();
            $table->string('nama_notaris', 50)->nullable();
            $table->string('no_suket_kemenkumham', 30)->nullable();
            $table->string('foto_suket', 150)->nullable();
            $table->string('perubahan_no_akta', 30)->nullable();
            $table->date('perubahan_tgl_akta')->nullable();
            $table->string('perubahan_nama_notaris', 30)->nullable();
            $table->string('pengurus_nama', 50)->nullable();
            $table->string('pengurus_nik', 20)->nullable();
            $table->string('pengurus_jabatan', 30)->nullable();
            $table->string('pengurus_foto', 150)->nullable();
            $table->string('pengurus_ktp', 150)->nullable();
            $table->string('npwp', 30)->nullable();
            $table->string('foto_npwp', 150)->nullable();
            $table->string('foto_kantor', 150)->nullable();
            $table->dateTime('update_time')->nullable();
            $table->string('update_user', 20)->nullable();
            $table->integer('verifikasi')->nullable();
            $table->dateTime('verifikasi_time')->nullable();
            $table->string('verifikasi_user', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengelola_badan');
    }
};
