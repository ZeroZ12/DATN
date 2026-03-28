<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToYeuCauHoanTraTable extends Migration
{
    public function up()
    {
        Schema::table('yeu_cau_hoan_tra', function (Blueprint $table) {

            $table->dateTime('thoi_gian_tra_hang')->nullable()->after('ly_do');
            $table->dateTime('thoi_gian_nhan_hang')->nullable()->after('thoi_gian_tra_hang');
            $table->dateTime('thoi_gian_hoan_tien')->nullable()->after('thoi_gian_nhan_hang');
            $table->foreignId('id_nguoi_hoan_tien')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('thoi_gian_hoan_tien');
        });
    }

    public function down()
    {
        Schema::table('yeu_cau_hoan_tra', function (Blueprint $table) {
            $table->dropForeign(['id_nguoi_hoan_tien']);
            $table->dropColumn([

                'thoi_gian_tra_hang',
                'thoi_gian_nhan_hang',
                'thoi_gian_hoan_tien',
                'id_nguoi_hoan_tien',
            ]);
        });
    }
}

