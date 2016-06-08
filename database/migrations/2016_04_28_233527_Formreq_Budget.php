<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqBudget extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_Budget', function (Blueprint $table) {
            $table->increments('Formreq_Budget_ID');
            $table->integer('FormReqID');
            $table->string('Formreq_Budget_Topic');
            $table->float('Formreq_Budget_Amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_Budget');
    }

}
