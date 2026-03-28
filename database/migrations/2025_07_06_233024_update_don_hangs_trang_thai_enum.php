<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cập nhật enum trang_thai để khớp với model DonHang
        DB::statement("ALTER TABLE don_hangs MODIFY COLUMN trang_thai ENUM(
            'cho_xac_nhan',
            'cho_thanh_toan',
            'da_xac_nhan',
            'chuan_bi_hang',
            'dang_giao_hang',
            'giao_thanh_cong',
            'giao_that_bai',
            'hoan_thanh',
            'da_huy',
            'yeu_cau_hoan_tra',
            'da_hoan_tien'
        ) NOT NULL DEFAULT 'cho_xac_nhan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Khôi phục lại enum ban đầu
        DB::statement("ALTER TABLE don_hangs MODIFY COLUMN trang_thai ENUM(
            'cho_xu_ly',
            'dang_giao',
            'hoan_thanh',
            'huy'
        ) NOT NULL DEFAULT 'cho_xu_ly'");
    }
};

