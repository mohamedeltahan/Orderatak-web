<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestoredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restoreds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('confirmed')->default(0);
            $table->unsignedInteger('name_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('order_id');
            $table->string('size')->nullable();
            $table->string('reason')->nullable();
            $table->integer('quantity')->nullable();
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
        Schema::drop('restoreds');
    }
}
