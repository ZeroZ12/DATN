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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don', 100)->unique();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_dia_chi_nguoi_dungs')->constrained('dia_chi_nguoi_dungs');
            $table->foreignId('id_phuong_thuc_thanh_toan')->constrained('phuong_thuc_thanh_toans');
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
        Schema::dropIfExists('don_hangs');
    }
};