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
            $table->decimal('tong_tien', 12, 2);
            $table->decimal('tong_tien_goc',12, 2)->default(0);
            $table->decimal('giam_gia', 12, 2)->default(0);
            $table->enum('trang_thai', ['cho_xac_nhan','cho_thanh_toan','chuan_bi_hang','da_xac_nhan','da_huy','dang_giao_hang','giao_thanh_cong','giao_that_bai','hoan_thanh']);
            $table->enum('huy_boi', ['admin', 'khach_hang', 'he_thong'])->default('he_thong');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('id_ma_giam_gia')->unsigned()->nullable()->default(null);
            $table->softDeletes();
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