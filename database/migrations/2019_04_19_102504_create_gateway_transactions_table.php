<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewayTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_transactions', function (Blueprint $table) {
            $table->increments('gateway_transaction_id');
            $table->integer('gateway_transaction_bank_transaction_id')
                  ->nullable();
            $table->integer('gateway_transaction_amount');
            $table->string('gateway_transaction_ref_number')->nullable();
            $table->string('gateway_transaction_res_number');
            $table->string('gateway_transaction_description')->nullable();
            $table->tinyInteger('gateway_transaction_status')->default(0);
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
        Schema::dropIfExists('gateway_transactions');
    }
}
