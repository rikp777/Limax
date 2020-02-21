<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalletLabelCheckWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pallet_label_weight_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expected_weight');
            $table->integer('actual_weight');
            $table->double('percentage');
            $table->boolean('valid');
            $table->timestamps();

            // relation palletlabel table
            $table->unsignedInteger('pallet_label_id');
            $table->foreign('pallet_label_id')->references('id')->on('pallet_labels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pallet_label_weight_checks');
    }
}
