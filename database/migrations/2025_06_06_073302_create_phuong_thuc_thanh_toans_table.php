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
        Schema::create('phuong_thuc_thanh_toans', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 100);
            $table->text('mo_ta')->nullable();
            $table->boolean('hoat_dong')->default(true);
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phuong_thuc_thanh_toans', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('phuong_thuc_thanh_toans');
    }
};