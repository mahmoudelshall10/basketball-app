<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_reports', function (Blueprint $table) {
            $table->bigIncrements('association_report_id');
            $table->string('referee_fullname_ar');
            $table->integer('referee_card_number');
            $table->string('match_date');
            $table->float('refereeing_allowance');
            $table->float('transition_allowance');
            $table->float('subsistance_allowance');
            $table->float('tournament_allowance');  
            $table->float('total_refereeing_allowance');
            $table->float('total_transition_allowance');
            $table->float('total_subsistance_allowance');
            $table->float('total_tournament_allowance');
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
        Schema::dropIfExists('association_reports');
    }
}
