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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description",255);
            $table->integer("discount")->nullable();
            $table->integer("available_quantity");
            $table->integer("sold_quantity");
            $table->timestamps();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('seller_id');


            $table->foreign("seller_id")
            ->references('id')->on('sellers')
            ->onDelte("cascade")
            ->onUpdate("cascade");

            $table->foreign("store_id")
            ->references('id')->on('stores')
            ->onDelte("cascade")
            ->onUpdate("cascade");


  

   

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
