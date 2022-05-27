<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('state')->nullable();
            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign("item_id")->references("id")->on("items")->onDelete("cascade");
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
        Schema::drop('alerts');
    }
}
