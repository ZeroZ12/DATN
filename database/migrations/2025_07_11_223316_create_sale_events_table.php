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
        Schema::create('sale_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('sale_event_product_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_event_id')->constrained('sale_events')->onDelete('cascade');
            $table->foreignId('bien_the_san_pham_id')->constrained('bien_the_san_pham')->onDelete('cascade');
            $table->decimal('sale_price_override', 10, 2)->nullable(); // Giá sale riêng cho sản phẩm trong event này
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_event_product_variant');
        Schema::dropIfExists('sale_events');
    }
};
