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
        Schema::create('pejabat', function (Blueprint $table) {
            $table->integer('id_pejabat', true);
            $table->integer('tahun_pengelolaan');
            $table->string('nama_pejabat', 50);
            $table->string('nip_pejabat', 20);
            $table->string('pangkat_pejabat', 30)->nullable();
            $table->integer('actived');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat');
    }
};
