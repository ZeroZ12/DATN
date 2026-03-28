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
        Schema::create("chat_histories", function (Blueprint $table){
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->text("user_message");
            $table->text("bot_reply");
            $table->timestamps();
        
    });
    }
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

