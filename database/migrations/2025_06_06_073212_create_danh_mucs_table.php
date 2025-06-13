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
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 255);
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('danh_mucs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('danh_mucs');
    }
};