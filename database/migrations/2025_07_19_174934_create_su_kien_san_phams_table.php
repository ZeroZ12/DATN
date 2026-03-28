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
        Schema::create('su_kien_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_su_kien')->constrained('su_kiens')->onDelete('cascade');
            $table->foreignId('id_san_pham')->nullable()->constrained('san_phams')->onDelete('cascade');
            $table->foreignId('id_bien_the_san_pham')->nullable()->constrained('bien_the_san_phams')->onDelete('cascade');
            $table->decimal('gia_su_kien', 12, 2);
            $table->decimal('gia_goc', 12, 2)->nullable();  
            $table->decimal('gia_goc_khi_bat_dau', 12, 2)->nullable();  
            $table->integer('so_luong_gioi_han')->nullable(); 
            $table->boolean('hien_thi')->default(true)->comment('1: Hiển thị, 0: Ẩn');
            // Optional discount price
            // $table->integer('so_luong')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('su_kien_san_phams');
    }
};

