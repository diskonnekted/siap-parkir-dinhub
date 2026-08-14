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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_users', true);
            $table->string('username', 20);
            $table->string('email', 50);
            $table->binary('password');
            $table->string('nama', 50);
            $table->enum('level', ['admin', 'pengelola']);
            $table->enum('status', ['badan', 'perorangan'])->nullable();
            $table->integer('langkah')->nullable();
            $table->integer('actived');
            $table->dateTime('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
