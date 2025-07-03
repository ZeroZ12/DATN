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
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->string('ten_san_pham_tai_thoi_diem')->nullable()->after('id_bien_the');
        });
    }

    public function down()
    {
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->dropColumn('ten_san_pham_tai_thoi_diem');
        });
    }
};
