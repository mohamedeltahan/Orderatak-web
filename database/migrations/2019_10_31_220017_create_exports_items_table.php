<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExportsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('name_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('size')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount')->nullable();
            $table->unsignedInteger('export_id')->nullable();
            $table->foreign('name_id')->references('id')->on('names')->onDelete("cascade");

            $table->foreign('export_id')->references('id')->on('exports')->onDelete("cascade");
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exports_items');
    }
}
