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
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don', 100)->unique();
            $table->foreignId('ma_nguoi_dung')->constrained('nguoi_dung');
            $table->foreignId('ma_dia_chi')->constrained('dia_chi_nguoi_dung');
            $table->foreignId('ma_phuong_thuc_thanh_toan')->constrained('phuong_thuc_thanh_toan');
            $table->decimal('tong_tien', 10, 2);
            $table->enum('trang_thai', ['cho_xu_ly', 'dang_giao', 'hoan_thanh', 'huy']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang');
    }
};