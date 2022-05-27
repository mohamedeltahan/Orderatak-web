<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('method')->nullable();
            $table->bigInteger('receipt_id')->nullable();
            $table->integer('paid')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('details')->nullable();
            $table->unsignedInteger("exporter_id");
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
