<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatewayTransaction extends Model
{
    protected $primaryKey = 'gateway_transaction_id';

    protected $guarded = ['gateway_transaction_id'];

    /*Relations*/

    public function bank_transaction()
    {
        return $this->hasMany(BankTransaction::class,
            'bank_transaction_gateway_transaction_id');
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class,
            'gateway_transactions_gateway_id');
    }
    /*End Relations*/
}
