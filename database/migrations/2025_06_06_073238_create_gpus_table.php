

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
        Schema::create('gpus', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 255);
            $table->text('mo_ta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gpus', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Xóa cột deleted_at khi rollback
        });
        Schema::dropIfExists('gpus');
    }
};