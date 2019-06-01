<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCallBackDataBankTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->longText('bank_transaction_callback_data')->nullable()
                  ->after('bank_transaction_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->dropColumn('bank_transaction_callback_data');
        });
    }
}
