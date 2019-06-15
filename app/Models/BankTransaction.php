<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{

    protected $primaryKey = 'bank_transaction_id';

    protected $guarded = ['bank_transaction_id'];

    /*Relations*/
    public function payment()
    {
        return $this->hasMany(Payment::class, 'payment_bank_transaction_id');
    }

    public function gateway_transaction()
    {
        return $this->belongsTo(GatewayTransaction::class,
            'bank_transaction_gateway_transaction_id');
    }

    /*End Relations*/

    public function updateCallBackData(array $params)
    {
        $this->attributes['bank_transaction_callback_data']
            = serialize($params);
        $this->save();
    }

    public function getBankTransactionCallBackData($data)
    {
        return unserialize($data);
    }
}
