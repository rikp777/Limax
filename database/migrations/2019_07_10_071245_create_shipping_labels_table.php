<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('transport_date');
            $table->dateTime("transport_delivery_date");
            $table->string("transport_driver");

            $table->timestamps();
            $table->softDeletes();

            // relation to user table
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // relation to article_groups table
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            //relation to farmers table
            $table->unsignedInteger('farmer_id');
            $table->foreign('farmer_id')->references('id')->on('farmers');

            //relation to farmers table
            $table->unsignedInteger('truck_id');
            $table->foreign('truck_id')->references('id')->on('trucks');

            //relation to user table with who work in the department of driver
            $table->unsignedInteger('transport_driver_user_id');
            $table->foreign('transport_driver_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('shipping_labels');
    }
}
