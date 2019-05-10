<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewayPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_plans', function (Blueprint $table) {
            $table->increments('gateway_plan_id');
            $table->string('gateway_plan_title');
            $table->float('gateway_plan_commission');
            $table->tinyInteger('gateway_plan_withdrawal_rate');
            $table->integer('gateway_plan_withdrawal_max');
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
        Schema::dropIfExists('gateway_plans');
    }
}
