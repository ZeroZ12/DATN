
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
        Schema::create('danh_gia_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product')->constrained('san_phams')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->integer('so_sao');
            $table->text('binh_luan')->nullable();
            $table->timestamps();
            $table->enum('trang_thai', ['cho_duyet', 'da_duyet', 'tu_choi'])->default('cho_duyet');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('danh_gia_san_phams', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('danh_gia_san_phams');
    }
};
