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
        Schema::create('ma_giam_gia_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ma_giam_gia_id')->constrained('ma_giam_gias')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('so_lan_su_dung')->default(0);
            $table->timestamps();
            $table->unique(['ma_giam_gia_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gia_users');
    }
};
