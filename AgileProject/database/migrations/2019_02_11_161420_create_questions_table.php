<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fixed_question_id')->unsigned();
            $table->integer('questionnaire_id')->unsigned();
            $table->foreign('fixed_question_id')
                    ->references('id')->on('fixed_questions');
            $table->foreign('questionnaire_id')
                    ->references('id')->on('questionnaires');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
