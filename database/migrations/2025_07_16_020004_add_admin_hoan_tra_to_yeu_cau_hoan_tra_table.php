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
        Schema::table('yeu_cau_hoan_tra', function (Blueprint $table) {
            $table->string('admin_hoan_tra')->nullable();
            $table->foreign('admin_hoan_tra')
            ->references('ten_dang_nhap')
            ->on('users')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yeu_cau_hoan_tra', function (Blueprint $table) {
            $table->dropForeign(['admin_hoan_tra']);
            $table->dropColumn('admin_hoan_tra');
        });
    }
};

