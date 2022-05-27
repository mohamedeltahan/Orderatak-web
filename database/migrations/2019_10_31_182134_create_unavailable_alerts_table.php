<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnavailableAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unavailable_alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('state')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->integer("size")->nullable();
            $table->unsignedInteger("name_id");
            $table->foreign("name_id")->references("id")->on("names")->onDelete("cascade");
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
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
        Schema::drop('unavailable_alerts');
    }
}
