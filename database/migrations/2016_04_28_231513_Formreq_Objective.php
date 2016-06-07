<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqObjective extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_Objective', function (Blueprint $table) {
            $table->increments('Formreq_Objective_ID');
            $table->integer('FormReqID');
            $table->string('Objective');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_Objective');
    }

}
