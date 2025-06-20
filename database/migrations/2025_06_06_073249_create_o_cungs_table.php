
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
        Schema::create('o_cungs', function (Blueprint $table) {
            $table->id();
            $table->string('loai', 50);
            $table->string('dung_luong', 100);
            // $table->decimal('gia', 10, 2);
            // $table->decimal('gia_sale', 10, 2);
            $table->longText('mo_ta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('o_cungs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::dropIfExists('o_cungs');
    }
};
