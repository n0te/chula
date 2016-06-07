<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqAuthorizedPerson extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_AuthorizedPerson', function (Blueprint $table) {
            $table->increments('Formreq_AuthorizedPerson_ID');
            $table->integer('FormReqID');
            $table->string('AuthorizedPersonTitle');
            $table->string('AuthorizedPersonFirstname');
            $table->string('AuthorizedPersonLastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_AuthorizedPerson');
    }

}
