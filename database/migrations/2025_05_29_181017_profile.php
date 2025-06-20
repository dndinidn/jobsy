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
        Schema::create('profiles', function (Blueprint $table) {
      $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke tabel users
            $table->string('profile_picture')->nullable(); // kolom untuk menyimpan nama file foto profil
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
   Schema::dropIfExists('profiles');
    }
};
