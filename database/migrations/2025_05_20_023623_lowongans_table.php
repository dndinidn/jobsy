<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users (user dengan role perusahaan)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title'); // Judul lowongan
            $table->string('location'); // Lokasi kerja

            // ENUM untuk tipe pekerjaan
            $table->enum('employment_type', ['Full-time', 'Part-time']);

            $table->text('description'); // Deskripsi pekerjaan

            // Kategori pekerjaan dari tabel categories
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');

            $table->string('salary'); // Gaji
            $table->timestamp('posted_at')->useCurrent(); // Tanggal posting

            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('lowongans');
    }
};