<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('anh_minh_chungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_yeu_cau_hoan_tra')
                  ->constrained('yeu_cau_hoan_tra')
                  ->onDelete('cascade');
            $table->string('duong_dan'); // ví dụ: /storage/minhchung/abc.jpg
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anh_minh_chungs');
    }
};
