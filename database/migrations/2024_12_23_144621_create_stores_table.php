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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->string("discretion",255);
            $table->integer("rank");
            $table->timestamps();

    $table->unsignedBigInteger("seller_id");
    
    $table->foreign("seller_id")
            ->references("id")
            ->on("sellers")
            ->onDelte("cascade")
            ->onUpdate("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
