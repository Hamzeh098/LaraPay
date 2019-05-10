<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithDrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('with_drawals', function (Blueprint $table) {
            $table->increments('withdrawal_id');
            $table->integer('withdrawal_gateway_id');
            $table->integer('withdrawal_user_account_id');
            $table->integer('withdrawal_amount');
            $table->float('withdrawal_commission');
            $table->string('withdrawal_ref_number')->nullable();
            $table->tinyInteger('withdrawal_status')->default(0);
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
        Schema::dropIfExists('with_drawals');
    }
}
