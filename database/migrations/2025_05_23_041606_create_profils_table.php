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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();

            // foreign key ke tabel users
            $table->unsignedBigInteger('user_id');
            $table->string('nama'); // nama yang diambil dari user
            $table->string('email'); // email yang diambil dari user
            $table->string('gambar')->nullable(); // path ke gambar profil

            $table->timestamps();

            // Relasi dengan tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
