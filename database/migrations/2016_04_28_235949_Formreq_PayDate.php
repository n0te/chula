<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqPayDate extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_PayDate', function (Blueprint $table) {
            $table->increments('Formreq_PayDate_ID');
            $table->integer('FormReqID');
            $table->string('PayDateAmount');
            $table->string('PayDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_PayDate');
    }

}
