<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalletLabelShippingLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('shipping_pallet_labels', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->timestamps();
//        });
        Schema::create('pallet_label_shipping_label', function (Blueprint $table) {
            // relation to shipping Labels table
            $table->unsignedInteger('shipping_label_id');
            $table->foreign('shipping_label_id', 'shipping_label_id_foreign')->references('id')->on('shipping_labels')->onDelete('cascade');

            // relation to pallet Labels table
            $table->unsignedInteger('pallet_label_id');
            $table->foreign('pallet_label_id', 'pallet_label_id_foreign')->references('id')->on('pallet_labels')->onDelete('cascade');

            // both primary
//            $table->primary(['shippinglabel_id', 'palletlabel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('shipping_pallet_labels');
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pallet_label_shipping_label');
    }
}
