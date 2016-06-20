<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->unsigned();
            $table->integer('module')->unsigned();
            $table->integer('status')->unsigned();
            
            $table->foreign('user')->references('id')->on('users');    
            $table->foreign('module')->references('id')->on('modules'); 
            $table->foreign('status')->references('id')->on('module_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_modules');
    }
}
