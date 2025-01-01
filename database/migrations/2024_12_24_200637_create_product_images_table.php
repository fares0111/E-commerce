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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string("path");
            $table->timestamps();

            $table->unsignedBigInteger('product_id');


            $table->foreign("product_id")
            ->references('id')->on('products')
            ->onDelte("cascade")
            ->onUpdate("cascade");


        });
    }

    /**

     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
