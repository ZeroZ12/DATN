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
        Schema::create('gio_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoi_dung')->constrained('users')->onDelete('cascade');
            $table->enum('loai', ['chinh', 'luu_sau', 'so_sanh'])->default('chinh');
            $table->foreignId('ma_giam_gia')->nullable()->constrained('ma_giam_gia');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gio_hang');
    }
};