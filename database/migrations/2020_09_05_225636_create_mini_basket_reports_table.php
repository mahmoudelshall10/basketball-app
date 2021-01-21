<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiniBasketReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mini_basket_reports', function (Blueprint $table) {
            $table->bigIncrements('mini_basket_report_id');
            $table->string('referee_fullname_ar');
            $table->integer('referee_card_number');
            $table->string('match_date');
            $table->float('period_value');
            $table->float('feeding_allowance');
            $table->float('transition_allowance');
            $table->float('total_number_of_periods');
            $table->float('total_value_of_the_periods');
            $table->float('total_transition_allowance');
            $table->float('total_feeding_allowance');
            $table->float('total_amount');
            $table->float('ten_percent_taxes');
            $table->float('net_amount');
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
        Schema::dropIfExists('mini_basket_reports');
    }
}
