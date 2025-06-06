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
        Schema::create('san_pham', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 255);
            $table->string('ma_san_pham', 100)->unique();
            $table->text('mo_ta')->nullable();
            $table->foreignId('id_chip')->constrained('chip');
            $table->foreignId('id_mainboard')->constrained('mainboard');
            $table->foreignId('id_gpu')->constrained('gpu');
            $table->foreignId('ma_danh_muc')->constrained('danh_muc');
            $table->foreignId('ma_thuong_hieu')->constrained('thuong_hieu');
            $table->integer('bao_hanh_thang');
            $table->boolean('hoat_dong')->default(true);
            $table->string('anh_dai_dien', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};