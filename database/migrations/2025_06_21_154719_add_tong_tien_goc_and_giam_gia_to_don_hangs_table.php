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
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->decimal('tong_tien_goc', 10, 2)->default(0)->after('tong_tien');
            $table->decimal('giam_gia', 10, 2)->default(0)->after('tong_tien_goc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->dropColumn(['tong_tien_goc', 'giam_gia']);
        });
    }
};
