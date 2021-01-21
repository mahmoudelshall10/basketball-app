<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->bigIncrements('exam_answer_id');
            $table->integer('referee_id')->index()->nullable();
            $table->integer('exam_id')->index()->nullable();
            $table->integer('question_id')->index()->nullable();
            $table->integer('option_id')->index()->nullable();
            $table->string('text_option')->nullable();
            $table->string('answer_score')->nullable();
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
        Schema::dropIfExists('exam_answers');
    }
}
