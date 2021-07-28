<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches_referees', function (Blueprint $table) {
            $table->bigIncrements('matches_referee_id');

            $table->unsignedBigInteger('leage_matches_id')->index()->nullable();
            $table->unsignedBigInteger('referee_id')->index()->nullable();
            $table->unsignedBigInteger('referee_role_id')->index()->nullable();
            
            $table->enum('match_acceptance',['pending', 'decline', 'accept'])->default('pending');
            $table->longText('match_decline_reason')->nullable();
            $table->tinyInteger('match_confirmation')->nullable()->default(0);
            $table->tinyInteger('match_verification')->default(0);
            $table->double('num_of_periods');
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
        Schema::dropIfExists('matches_referees');
    }
}
