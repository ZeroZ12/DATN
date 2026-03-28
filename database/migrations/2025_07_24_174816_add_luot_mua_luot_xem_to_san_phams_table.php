<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLuotMuaLuotXemToSanPhamsTable extends Migration
{
    public function up()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->unsignedInteger('luot_mua')->default(0);
            $table->unsignedInteger('luot_xem')->default(0);
        });
    }

    public function down()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn(['luot_mua', 'luot_xem']);
        });
    }
}

