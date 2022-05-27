<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('name_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('size')->nullable();
            $table->double('buying_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->integer('discount')->nullable();
            $table->unsignedInteger('store_id')->nullable();
           // $table->unsignedInteger('export_id')->nullable();
            $table->integer('alert_time')->nullable();
            $table->unsignedInteger('alert_quantity')->nullable();
            $table->foreign("store_id")->references("id")->on("stores")->onDelete("cascade");
            $table->foreign("name_id")->references("id")->on("names")->onDelete("cascade");

            //   $table->foreign("export_id")->references("id")->on("exports")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
