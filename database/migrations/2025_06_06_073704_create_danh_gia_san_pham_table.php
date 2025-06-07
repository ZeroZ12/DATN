
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
        Schema::create('danh_gia_san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_san_pham')->constrained('san_pham');
            $table->foreignId('ma_nguoi_dung')->constrained('users');
            $table->integer('so_sao');
            $table->text('binh_luan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gia_san_pham');
    }
};