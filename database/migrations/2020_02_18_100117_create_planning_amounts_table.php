<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanningAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_amounts', function (Blueprint $table) {
            //useless primary key but is needed for eloquent to work...... kut laravel
            $table->increments('id');
            $table->unsignedInteger('planning_id');
            $table->foreign('planning_id')->references('id')->on('plannings');

            // relation sort-types table
            $table->unsignedInteger('sort_type_id');
            $table->foreign('sort_type_id')->references('id')->on('sort_types')->onDelete('cascade');

            $table->integer('amount');

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
        Schema::dropIfExists('planning_amounts');
    }
}
