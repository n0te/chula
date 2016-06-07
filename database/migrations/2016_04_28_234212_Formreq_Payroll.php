<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqPayroll extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_Payroll', function (Blueprint $table) {
            $table->increments('Formreq_Payroll_ID');
            $table->integer('FormReqID');
            $table->string('Payroll_Name');
            $table->float('Payroll_Amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_Payroll');
    }

}
