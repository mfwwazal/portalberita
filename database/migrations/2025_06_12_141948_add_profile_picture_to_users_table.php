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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'profile_picture'
            // nullable() berarti kolom ini boleh kosong
            // after('email') akan menempatkan kolom setelah kolom 'email' (opsional, bisa dihilangkan)
            $table->string('profile_picture')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Saat rollback, hapus kolom 'profile_picture'
            $table->dropColumn('profile_picture');
        });
    }
};