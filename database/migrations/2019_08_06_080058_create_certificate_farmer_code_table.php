<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateFarmerCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_farmer_codes', function (Blueprint $table) {
            // relation to certificate table
            $table->unsignedInteger('certificate_id');
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');

            // relation to user table
            $table->unsignedInteger('farmer_id');
            $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');

            // code col
            $table->string('code');

            // both primary
            $table->primary(['certificate_id', 'farmer_id']);
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
        Schema::dropIfExists('certificate_farmer_code');
    }
}
