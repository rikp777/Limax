<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_user', function (Blueprint $table) {
            //relation to departments table
            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            // relation to user table
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user');

            // both primary
            $table->primary(['department_id', 'user_id']);
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
        Schema::dropIfExists('department_user');
    }
}
