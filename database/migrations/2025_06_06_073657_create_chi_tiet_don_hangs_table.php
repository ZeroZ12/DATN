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
        Schema::create('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_don_hang')->constrained('don_hangs');
            $table->foreignId('id_bien_the')->nullable()->constrained('bien_the_san_phams');
            $table->string('ten_hien_thi', 255);
            $table->integer('so_luong');
            $table->decimal('don_gia', 10, 2);
            $table->integer('bao_hanh_thang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_don_hangs');
    }
};