<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('title')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->date('dob');
            $table->string('password', 60);
            $table->rememberToken();
            $table->string('student_id');
            $table->integer('type')->unsigned();
            $table->string('citizen_id');
            $table->string('passport_id');
            $table->boolean('status');
            $table->integer('department')->unsigned()->nullable();
            $table->integer('occupation')->unsigned()->nullable();
            $table->integer('nationality')->unsigned();
            $table->integer('sex')->unsigned();
            $table->string('company');
            $table->string('advisor');
            $table->string('researchtopic');
            $table->string('tel');
            $table->string('address');
            
            $table->timestamps();

            $table->foreign('occupation')->references('id')->on('occupations');
            $table->foreign('title')->references('id')->on('titles');
            $table->foreign('nationality')->references('id')->on('nationalities');
            $table->foreign('department')->references('id')->on('departments');
            $table->foreign('type')->references('id')->on('user_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
