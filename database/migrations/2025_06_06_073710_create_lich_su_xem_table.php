
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
        Schema::create('lich_su_xem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_nguoi_dung')->nullable()->constrained('nguoi_dung');
            $table->string('ma_phien');
            $table->foreignId('ma_san_pham')->constrained('san_pham');
            $table->timestamp('thoi_gian_xem')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_xem');
    }
};