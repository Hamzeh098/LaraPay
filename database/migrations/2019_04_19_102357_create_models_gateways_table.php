<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->increments('gateway_id');
            $table->tinyInteger('gateway_plan');
            $table->string('gateway_title');
            $table->integer('gateway_user_id');
            // $table->string('gateway_website')->nullable();
            $table->bigInteger('gateway_balance')->default(0);
            $table->string('access_token');
            $table->smallInteger('gateway_default_bank')->nullable();
            $table->tinyInteger('gateway_status')->default(0);
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
        Schema::dropIfExists('models_gateways');
    }
}
