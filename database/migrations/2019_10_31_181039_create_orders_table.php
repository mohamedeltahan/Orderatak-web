<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('policy_id');

            $table->timestamps();
            $table->double('total_price_before_discount')->nullable();
            $table->double('total_price_after_discount')->nullable();
            $table->string('discount')->nullable();
            $table->integer('no_of_items')->nullable();
            $table->date('receiving_date')->nullable();
            $table->dateTime('ordering_date')->nullable();
            $table->string('receiving_address')->nullable();
            $table->string('state')->nullable();
            $table->double("delivery")->nullable();
            $table->string("details")->nullable();
            $table->string("type")->nullable();
            $table->double("prev_total")->default(0);
            $table->unsignedInteger("ship_id")->nullable();
            $table->boolean('completed')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete("cascade");

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
