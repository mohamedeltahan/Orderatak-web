<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('name_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('size')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('buying_price')->nullable();
            $table->double('discount')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('name_id')->references('id')->on('names')->onDelete("cascade");
            $table->foreign('order_id')->references('id')->on('orders')->onDelete("cascade");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_items');
    }
}
