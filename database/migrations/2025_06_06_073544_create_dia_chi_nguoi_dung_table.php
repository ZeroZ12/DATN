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
        Schema::create('dia_chi_nguoi_dung', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoi_dung')->constrained('users')->onDelete('cascade');
            $table->text('dia_chi');
            $table->string('thanh_pho', 100);
            $table->string('quan_huyen', 100);
            $table->string('phuong_xa', 100);
            $table->boolean('la_mac_dinh')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_chi_nguoi_dung');
    }
};