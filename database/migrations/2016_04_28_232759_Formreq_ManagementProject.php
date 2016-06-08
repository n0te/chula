<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqManagementProject extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_ManagementProject', function (Blueprint $table) {
            $table->increments('Formreq_ManagementProject_ID');
            $table->integer('FormReqID');
            $table->string('ManagementProjectTitle');
            $table->string('ManagementProjectFirstname');
            $table->string('ManagementProjectLastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_ManagementProject');
    }

}
