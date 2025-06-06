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
        Schema::create('chi_tiet_gio_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_gio_hang')->constrained('gio_hang')->onDelete('cascade');
            $table->foreignId('ma_san_pham')->constrained('san_pham');
            $table->foreignId('ma_bien_the')->nullable()->constrained('bien_the_san_pham');
            $table->integer('so_luong');
            $table->decimal('gia', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_gio_hang');
    }
};