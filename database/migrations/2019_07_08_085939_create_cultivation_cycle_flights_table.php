<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCultivationCycleFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cultivation_cycle_flights', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->timestamps();

            // relation to article_groups table
            $table->unsignedInteger('cultivation_cycle_id');
            $table->foreign('cultivation_cycle_id')->references('id')->on('cultivation_cycles');
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
        Schema::dropIfExists('cultivation_cycle_flights');
    }
}
