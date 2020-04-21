<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');

            // relation to cell table
            $table->unsignedInteger('cell_id');
            $table->foreign('cell_id')->references('id')->on('cells');

            // relation to farmers table
            $table->unsignedInteger('farmer_id');
            $table->foreign('farmer_id')->references('id')->on('farmers');

            // relation to statuses table
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plannings');
    }
}
