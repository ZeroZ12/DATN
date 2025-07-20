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
        Schema::table('su_kien_san_pham', function (Blueprint $table) {
            $table->boolean('hien_thi')->default(true)->after('quantity_limit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('su_kien_san_pham', function (Blueprint $table) {
            $table->dropColumn('hien_thi');
        });
    }
};
