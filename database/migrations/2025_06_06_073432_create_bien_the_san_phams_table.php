

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
        Schema::create('bien_the_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_product')->constrained('san_phams');
            $table->foreignId('id_ram')->constrained('rams');
            $table->foreignId('id_o_cung')->constrained('o_cungs');
            $table->decimal('gia', 10, 2);
            $table->decimal('gia_so_sanh', 10, 2);
            $table->integer('ton_kho');
            $table->string('ma_bien_the', 100)->unique();
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
        Schema::table('bien_the_san_phams', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('bien_the_san_phams');
    }
};