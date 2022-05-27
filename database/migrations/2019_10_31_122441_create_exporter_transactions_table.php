<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExporterTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exporter_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('receipt_id')->nullable();
            $table->bigInteger('paid')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('details')->nullable();
            $table->string('method')->nullable();
            $table->unsignedInteger('export_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("export_id")->references("id")->on("exports")->onDelete("cascade");
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exporter_transactions');
    }
}
