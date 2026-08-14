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
        Schema::create('tahun_pengelolaan', function (Blueprint $table) {
            $table->integer('id_tahun_pengelolaan', true);
            $table->integer('tahun_pengelolaan');
            $table->integer('actived');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_pengelolaan');
    }
};
