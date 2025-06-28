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
        Schema::table('dia_chi_nguoi_dungs', function (Blueprint $table) {
            $table->string('tinh_thanh_pho_name')->nullable();
            $table->string('quan_huyen_name')->nullable();
            $table->string('phuong_xa_name')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dia_chi_nguoi_dungs', function (Blueprint $table) {
            //
        });
    }
};
