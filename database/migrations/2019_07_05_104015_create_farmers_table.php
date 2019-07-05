<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();;
            $table->string('street');
            $table->string('house_number');
            $table->string('place');
            $table->string('zip_code');
            $table->string('country');
            $table->string('province');
            $table->string('email')->unique();;
            $table->bigInteger('phone')->unique();;
            $table->bigInteger('fax')->nullable()->unique();;
            $table->bigInteger('fairproduce_number')->unique();;
            $table->bigInteger('ggn')->unique();;
            $table->bigInteger('skal')->unique();;
            $table->bigInteger('milieu')->unique();;
            $table->timestamps();

            // farmers preference article
            // relation to article_groups table
            $table->unsignedInteger('article_group_id');
            $table->foreign('article_group_id')->references('id')->on('article_groups')->onDelete('cascade');

            // farmers contact person
            // relation to article_groups table
            $table->unsignedInteger('contact_person');
            $table->foreign('contact_person')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('farmers');
    }
}
