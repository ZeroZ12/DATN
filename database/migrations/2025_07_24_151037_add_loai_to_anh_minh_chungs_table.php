<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoaiToAnhMinhChungsTable extends Migration
{
    public function up(): void
    {
        Schema::table('anh_minh_chungs', function (Blueprint $table) {
            $table->enum('loai', ['nguoi_dung', 'admin'])->default('nguoi_dung')->after('id_yeu_cau_hoan_tra');
        });
    }

    public function down(): void
    {
        Schema::table('anh_minh_chungs', function (Blueprint $table) {
            $table->dropColumn('loai');
        });
    }
}
