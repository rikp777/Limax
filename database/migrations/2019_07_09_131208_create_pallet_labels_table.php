<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalletLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pallet_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->date('crop_date');
            $table->integer('article_amount');
            $table->string('note')->nullable();
            $table->integer('pallet_label_farmer_id');
            $table->string('made_by');


            $table->integer('cell_number');
            $table->string('cell_description')->nullable();
            $table->integer('harvest_cycle');
            $table->integer('harvest_cycle_day');

            $table->timestamps();
            $table->softDeletes();

            // relation to cell table
            $table->unsignedInteger('cell_id');
            $table->foreign('cell_id')->references('id')->on('cells');

            // relation to user table
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // relation to farmers table
            $table->unsignedInteger('farmer_id');
            $table->foreign('farmer_id')->references('id')->on('farmers');

            // relation to cultivation_cycles table
            $table->unsignedInteger('cultivation_cycle_id');
            $table->foreign('cultivation_cycle_id')->references('id')->on('cultivation_cycles')->onDelete('cascade');

            // relation to pallet_types table
            $table->unsignedInteger('pallet_type_id');
            $table->foreign('pallet_type_id')->references('id')->on('pallet_types');

            // relation to statuses table
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');

            // relation to articles table
            $table->unsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
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
        Schema::dropIfExists('pallet_labels');
    }
}
