<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('delivery');
            $table->integer('payment');
            $table->enum('status',['0','1','2'])->default('0');
            $table->longText('np')->nullable();
            $table->longText('np_warehouses')->nullable();
            $table->longText('fio');
            $table->longText('phone');
            $table->longText('email');
            $table->longText('total');
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
        Schema::dropIfExists('orders');
    }
}
