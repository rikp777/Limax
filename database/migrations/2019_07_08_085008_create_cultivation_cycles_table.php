<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCultivationCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cultivation_cycles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cell_description');
            $table->date('fill_date')->nullable();
            $table->timestamps();

            // relation to cell table
            $table->unsignedInteger('cell_id');
            $table->foreign('cell_id')->references('id')->on('cells');
            // relation to farmers table
            $table->unsignedInteger('farmer_id');
            $table->foreign('farmer_id')->references('id')->on('farmers');
            // relation to article_groups table
            $table->unsignedInteger('article_group_id');
            $table->foreign('article_group_id')->references('id')->on('article_groups');
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
        Schema::dropIfExists('cultivation_cycles');
    }
}
