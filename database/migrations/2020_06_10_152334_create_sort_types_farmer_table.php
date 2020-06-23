<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortTypesFarmerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_sort_type', function (Blueprint $table) {

            // relation to roles table
            $table->unsignedInteger('sort_type_id');
            $table->foreign('sort_type_id')->references('id')->on('sort_types');

            // relation to user table
            $table->unsignedInteger('farmer_id');
            $table->foreign('farmer_id')->references('id')->on('farmers');

            $table->timestamps();

            // both primary
            $table->primary(['sort_type_id', 'farmer_id']);
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
        Schema::dropIfExists('farmer_sort_type');
    }
}
