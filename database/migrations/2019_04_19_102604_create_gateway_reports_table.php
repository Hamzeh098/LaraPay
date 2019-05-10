<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewayReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_reports', function (Blueprint $table) {
            $table->increments('gateway_report_id');
            $table->integer('gateway_report_gateway_id');
            $table->date('gateway_report_date');
            $table->integer('gateway_report_desposit')->default(0);
            $table->integer('gateway_report_withdrawal')->default(0);
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
        Schema::dropIfExists('gateway_reports');
    }
}
