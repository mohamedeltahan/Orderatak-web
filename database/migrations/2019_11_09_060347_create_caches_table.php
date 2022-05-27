<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('details')->nullable();
            $table->string('client')->nullable();
            $table->double('amount')->nullable();
            $table->date('date')->nullable();
            $table->integer('receipt_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('caches');
    }
}
