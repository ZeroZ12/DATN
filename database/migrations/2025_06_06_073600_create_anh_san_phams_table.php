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
        Schema::create('anh_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product')->constrained('san_phams');
            $table->string('duong_dan', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anh_san_phams', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('anh_san_phams');
    }
};