<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->nullable()->unsigned();
            $table->foreign('page_id')->references('id')->on('pages');
            $table->longText('src');
            $table->longText('link');
            $table->longText('alt');
            $table->longText('title')->nullable();
            $table->longText('text')->nullable();
            $table->longText('button')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
