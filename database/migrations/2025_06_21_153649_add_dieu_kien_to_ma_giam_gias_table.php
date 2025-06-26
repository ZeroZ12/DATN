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
        Schema::table('ma_giam_gias', function (Blueprint $table) {
            $table->decimal('dieu_kien', 10, 2)->default(0)->after('gia_tri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ma_giam_gias', function (Blueprint $table) {
            $table->dropColumn('dieu_kien');
        });
    }
};
