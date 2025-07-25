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
Schema::create('beritas', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->text('konten');
    $table->string('gambar')->nullable();
    $table->timestamps();
});

Schema::create('berita_images', function (Blueprint $table) {
    $table->id();
    $table->foreignId('berita_id')->constrained('beritas')->onDelete('cascade');
    $table->string('path');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
