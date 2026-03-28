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
        Schema::create('yeu_cau_hoan_tra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_don_hang')->unsigned();
            $table->string('ma_hoan_tra', 100);
            $table->string('sdt_lien_he', 20);
            $table->enum('phuong_thuc_hoan_tien', ['momo', 'bank_transfer']);
            $table->string('ten_ngan_hang',100)->nullable();
            $table->string('so_tai_khoan', 50)->nullable();
            $table->string('ten_chu_tai_khoan', 100)->nullable();
            $table->text('ly_do')->nullable();
            $table->enum('trang_thai', ['cho_phe_duyet', 'da_phe_duyet', 'tu_choi', 'dang_van_chuyen_tra_hang', 'da_nhan_hang', 'da_hoan_tien'])
                ->default('cho_phe_duyet');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_hoan_tra');
    }
};

