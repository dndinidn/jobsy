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
 
    Schema::create('kategori_lowongan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('lowongan_id');
        $table->unsignedBigInteger('kategori_id');
        $table->foreign('lowongan_id')->references('id')->on('lowongan')->onDelete('cascade');
        $table->foreign('kategori_id')->references('id')->on('kategori_pekerjaan')->onDelete('cascade');

        $table->timestamps();
    });



        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
