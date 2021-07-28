<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancesValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowances_values', function (Blueprint $table) {
            $table->bigIncrements('allowances_values_id');
            $table->string('allowance_name');
            $table->enum('allowance_type',['association','cairo_area','mini_basket']);
            $table->integer('city_from')->index()->nullable();
            $table->integer('city_to')->index()->nullable();
            $table->enum('referee_place',['table','playground']);
            $table->enum('referee_type',["International","First Division","Second Division" , "Third Division", "Mini Basket","Commessioner"]);
            $table->integer('arbitration_allowance');
            $table->integer('transition_allowance');
            $table->integer('subsistance_allowance')->default(0)->nullable();
            $table->integer('period_value')->nullable();
            $table->enum('num_of_periods',[0,1,1.5,2,2.5,3])->default(0);
            $table->double('total_amount',10,2);
            $table->double('ten_percent_taxes');
            $table->double('net_amount',10,2);
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
        Schema::dropIfExists('allowances_value');
    }
}
