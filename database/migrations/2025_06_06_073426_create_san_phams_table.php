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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 255);
            $table->string('ma_san_pham', 100)->unique();
            $table->text('mo_ta')->nullable();
            $table->foreignId('id_chip')->constrained('chips');
            $table->foreignId('id_mainboard')->constrained('mainboards');
            $table->foreignId('id_gpu')->constrained('gpus');
            $table->foreignId('id_category')->constrained('danh_mucs');
            $table->foreignId('id_brand')->constrained('thuong_hieus');
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
        Schema::dropIfExists('san_phams');
    }
};