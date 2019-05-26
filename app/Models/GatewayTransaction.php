<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GatewayTransaction extends Model
{
    protected $primaryKey = 'gateway_transaction_id';

    protected $guarded = ['gateway_transaction_id'];
}
