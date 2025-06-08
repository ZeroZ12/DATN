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
        Schema::create('nhat_ky_ton_khos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bien_the')->nullable()->constrained('bien_the_san_phams');
            $table->integer('so_luong');
            $table->enum('loai', ['nhap', 'xuat', 'dieu_chinh']);
            $table->text('ly_do')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhat_ky_ton_khos');
    }
};