<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSimpleProductFieldsToSanPham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->decimal('gia', 15, 2)->nullable()->after('mo_ta');
            $table->integer('so_luong')->nullable()->after('gia');
            $table->string('sku')->nullable()->after('so_luong');
            $table->boolean('co_bien_the')->default(true)->after('sku');
            $table->unsignedBigInteger('id_chip')->nullable()->change();
            $table->unsignedBigInteger('id_mainboard')->nullable()->change();
            $table->unsignedBigInteger('id_gpu')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn(['gia', 'so_luong', 'sku', 'co_bien_the']);
            $table->unsignedBigInteger('id_chip')->nullable(false)->change();
            $table->unsignedBigInteger('id_mainboard')->nullable(false)->change();
            $table->unsignedBigInteger('id_gpu')->nullable(false)->change();
            

        });
    }
}
