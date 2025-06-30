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
        Schema::table('san_phams', function (Blueprint $table) {
            $table->unsignedBigInteger('id_case')->nullable();
            $table->unsignedBigInteger('id_tannhiet')->nullable();
            $table->unsignedBigInteger('id_nguon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn(['id_case', 'id_tannhiet', 'id_nguon']);
        });
    }
};
