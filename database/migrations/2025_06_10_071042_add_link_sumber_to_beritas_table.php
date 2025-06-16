<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_add_link_sumber_to_beritas_table.php

public function up()
{
    Schema::table('beritas', function (Blueprint $table) {
        $table->string('link_sumber')->nullable()->after('konten');
    });
}

public function down()
{
    Schema::table('beritas', function (Blueprint $table) {
        $table->dropColumn('link_sumber');
    });
}
};
