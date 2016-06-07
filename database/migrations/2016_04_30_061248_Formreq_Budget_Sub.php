<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormreqBudgetSub extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Formreq_Budget_Sub', function (Blueprint $table) {
            $table->increments('Formreq_Budget_Sub_ID');
            $table->integer('Formreq_Budget_ID');
            $table->string('Formreq_Budget_Sub_Topic');
            $table->float('Formreq_Budget_Sub_Amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Formreq_Budget_Sub');
    }

}
