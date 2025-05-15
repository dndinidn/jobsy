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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->constrained('perusahaan')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->foreignId('kategori_id')->constrained('kategori_pekerjaan');
            $table->foreignId('lokasi_id')->constrained('lokasi');
            $table->decimal('gaji', 10, 2);
            $table->string('gambar')->nullable(); // Menambahkan kolom untuk gambar
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade'); // Menambahkan kolom pengguna_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
