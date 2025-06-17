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
        Schema::create('dia_chi_nguoi_dungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ten_nguoi_nhan', 255); // Tên người nhận
            $table->string('so_dien_thoai_nguoi_nhan', 20); // Số điện thoại người nhận
            $table->text('dia_chi_day_du'); // Địa chỉ đầy đủ (VD: Số nhà, tên đường, thôn, xóm...)
            $table->string('tinh_thanh_pho', 100); // Tỉnh/Thành phố (Đổi 'thanh_pho' cho rõ ràng)
            $table->string('quan_huyen', 100);    // Quận/Huyện
            $table->string('phuong_xa', 100);     // Phường/Xã
            $table->boolean('mac_dinh')->default(false);
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_chi_nguoi_dungs');
    }
};