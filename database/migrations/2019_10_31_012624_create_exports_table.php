<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->double('total_price_before_discount')->nullable();
            $table->double('total_price_after_discount')->nullable();
            $table->float('discount')->nullable();
            $table->integer('no_of_items')->nullable();
            $table->date('receiving_dates')->nullable();
            $table->string('details')->nullable();
            $table->text('receipt_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('exporter_id')->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("exporter_id")->references("id")->on("exporters")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exports');
    }
}
