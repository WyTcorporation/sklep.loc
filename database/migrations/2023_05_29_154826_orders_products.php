<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('orders_id')->nullable()->unsigned();
            $table->foreign('orders_id')->references('id')->on('orders');
            $table->bigInteger('products_id')->nullable()->unsigned();
            $table->foreign('products_id')->references('id')->on('products');
            $table->integer('count');
            $table->integer('countPrice');
            $table->integer('quantity');
            $table->integer('price');
            $table->longText('product_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
}
