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
            $table->bigInteger('gioi_han_moi_user')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ma_giam_gias', function (Blueprint $table) {
            $table->dropColumn('gioi_han_moi_users');
        });
    }
};

