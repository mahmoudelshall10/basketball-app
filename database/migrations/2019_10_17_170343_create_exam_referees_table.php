<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_referees', function (Blueprint $table) {
            $table->bigIncrements('exam_referee_id');
            $table->integer('exam_id')->index()->nullable();
            $table->integer('referee_id')->index()->nullable();
            // $table->dateTime('exam_expiry_date')->nullable();
            // $table->string('exam_time_min')->nullable();
            $table->integer('exam_status')->default(0)->nullable();
            $table->string('exam_started_at')->nullable();
            $table->string('exam_ended_at')->nullable();
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
        Schema::dropIfExists('exam_referees');
    }
}
