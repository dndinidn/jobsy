<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();              // id primary key auto increment
            $table->string('name');    // nama kabupaten/kota
            $table->timestamps();      // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
};
