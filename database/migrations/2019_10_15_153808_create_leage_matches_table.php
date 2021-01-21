<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeageMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leage_matches', function (Blueprint $table) {
            $table->bigIncrements('leage_matches_id');
            $table->integer('league_id')->index()->nullable();
            $table->integer('home_team')->index()->nullable();
            $table->integer('away_team')->index()->nullable();
            $table->integer('match_hall')->index()->nullable();
            $table->boolean('is_sent')->default(0);
            $table->enum('num_of_periods',[0,1,1.5,2,2.5,3])->default(0);
            $table->string('match_date')->nullable();
            $table->string('score_sheet_image')->nullable();
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
        Schema::dropIfExists('leage_matches');
    }
}
