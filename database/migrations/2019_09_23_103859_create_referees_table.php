<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->bigIncrements('referee_id');
            $table->string('referee_username',50)->unique();
            $table->string('referee_mobile',12)->unique();
            $table->string('referee_email',50)->unique()->nullable();
            $table->string('refree_password');
            $table->string('referee_fullname')->nullable();
            $table->integer('gov_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('referee_address')->nullable();
            $table->date('referee_birthday')->nullable();
            $table->string('referee_nationl_identity')->nullable();
            $table->string('referee_identity')->nullable();
            $table->integer('referee_card_number')->nullable();
            $table->string('referee_image')->nullable();
            $table->string('referee_type')->nullable();
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
        Schema::dropIfExists('referees');
    }
}
