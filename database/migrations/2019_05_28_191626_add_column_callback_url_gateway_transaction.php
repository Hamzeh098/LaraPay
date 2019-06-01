<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCallbackUrlGatewayTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gateway_transactions', function (Blueprint $table) {
            $table->string('gateway_transaction_callback_url')
                ->after('gateway_transaction_description')->nullable();
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
            $table->dropColumn('gateway_transaction_callback_url');
        });
    }
}
