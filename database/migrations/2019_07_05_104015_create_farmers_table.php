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
            $table->string('uid')->unique();
            $table->string('name')->unique();
            $table->string('street');
            $table->string('house_number');
            $table->string('place');
            $table->string('zip_code');
            $table->string('country');
            $table->string('province');
            $table->string('email');
            $table->bigInteger('phone');
            $table->bigInteger('fax')->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();

            // farmers preference article
            // relation to article_groups table
            $table->unsignedInteger('preference_article_group_id');
            $table->foreign('preference_article_group_id')->references('id')->on('article_groups')->onDelete('cascade');

            // farmers contact person
            // relation to article_groups table
            $table->unsignedInteger('contact_person_user_id');
            $table->foreign('contact_person_user_id')->references('id')->on('users')->onDelete('cascade');
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
