<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('excel_code')->unique();
            $table->string('inset_gram');
            $table->integer('inset_limit');
            $table->integer('pallet_limit');
            $table->string('origin');
            $table->timestamps();
            $table->softDeletes();

            // relation to pallet_types table
            $table->unsignedInteger('pallet_type_id');
            $table->foreign('pallet_type_id')->references('id')->on('pallet_types')->onDelete('cascade');

            // relation to casks table
            $table->unsignedInteger('cask_id');
            $table->foreign('cask_id')->references('id')->on('casks')->onDelete('cascade');

            // relation to insets table
            $table->unsignedInteger('inset_id');
            $table->foreign('inset_id')->references('id')->on('insets')->onDelete('cascade');

            // relation to insets table
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            // relation to insets table
            $table->unsignedInteger('article_group_id');
            $table->foreign('article_group_id')->references('id')->on('article_groups')->onDelete('cascade');

            // relation sort-types table
            $table->unsignedInteger('sort_type_id');
            $table->foreign('sort_type_id')->references('id')->on('sort_types')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
}
