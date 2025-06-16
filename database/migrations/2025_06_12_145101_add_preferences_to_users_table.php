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
            // Tambahkan kolom language_preference
            // Default 'id' agar sesuai dengan bahasa default Indonesia
            $table->string('language_preference')->nullable()->default('id')->after('email');

            // Tambahkan kolom theme_preference
            // Default 'light' agar sesuai dengan tema default
            $table->string('theme_preference')->nullable()->default('light')->after('language_preference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom saat rollback
            $table->dropColumn('language_preference');
            $table->dropColumn('theme_preference');
        });
    }
};