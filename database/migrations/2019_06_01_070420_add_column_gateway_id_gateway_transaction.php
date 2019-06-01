<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGatewayIdGatewayTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gateway_transactions', function (Blueprint $table) {
            $table->integer('gateway_transaction_gateway_id')
                ->after('gateway_transaction_bank_transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gateway_transactions', function (Blueprint $table) {
            $table->dropColumn('gateway_transactions_gateway_id');
        });
    }
}
