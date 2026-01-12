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
    Schema::table('layanan', function (Blueprint $table) {
        // Menambahkan kolom warna_btn setelah kolom gambar
        $table->string('warna_btn')->nullable()->after('gambar');
    });
}

public function down()
{
    Schema::table('layanan', function (Blueprint $table) {
        $table->dropColumn('warna_btn');
    });
}
};
