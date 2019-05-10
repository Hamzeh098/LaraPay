<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->increments('user_account_id');
            $table->integer('user_account_user_id');
            $table->string('user_account_title', 50);
            $table->string('user_account_card_number');
            $table->string('user_account_sheba_number', 24);
            $table->string('user_account_number', 50);
            //$table->string('user_account_card_image',50);
            //$table->string('user_account_card_verify_status',50);
            $table->tinyInteger('user_account_status')->default(0);
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
        Schema::dropIfExists('user_accounts');
    }
}
