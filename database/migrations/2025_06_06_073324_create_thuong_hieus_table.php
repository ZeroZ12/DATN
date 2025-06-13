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
        Schema::create('thuong_hieus', function (Blueprint $table) {
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
        Schema::table('thuong_hieus', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('thuong_hieus');
    }
};