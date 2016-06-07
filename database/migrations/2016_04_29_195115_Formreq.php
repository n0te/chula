<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Formreq extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq', function (Blueprint $table) {
            $table->increments('FormReqID');
            $table->string('FormReqTopic');
            $table->string('FormReqDepartment');
            $table->string('FormReqTel');
            $table->string('FormReqAt');
            $table->string('FormReqTo');
            $table->string('FormReqDateReq');
            $table->string('FormReqRequesterTitle');
            $table->string('FormReqRequesterFirstname');
            $table->string('FormReqRequesterLastname');
            $table->string('FormReqSponser');
            $table->float('FormReqBudgetScholarship');
            $table->date('FormReqStartDateScholarship');
            $table->date('FormReqEndDateScholarship');

            $table->string('FormReqResponsibleProjectPerson');

            $table->string('FormReqBankName');
            $table->string('FormReqBranch');
            $table->string('FormReqAccountName');
            $table->string('FormReqAccountNumber');

            $table->date('FormReqReportDate');

            $table->integer('FormReqStstus');
            $table->date('FormReqSaveDate');
            $table->date('FormReqSendDate');
            $table->integer('FormReqUserIDCreate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq');
    }

}
