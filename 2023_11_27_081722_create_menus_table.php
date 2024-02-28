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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu');
            $table->decimal('harga', 10, 3); // precision: 10, scale: 3
            $table->string('deskripsi');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
