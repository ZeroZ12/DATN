<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chips', function (Blueprint $table) {
            $table->softDeletes(); // Tạo cột 'deleted_at' dạng nullable timestamp
        });
    }

    public function down()
    {
        Schema::table('chips', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
