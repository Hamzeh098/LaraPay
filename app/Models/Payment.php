<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $primaryKey = 'payment_id';
    
    protected $guarded = ['payment_id'];
    
    
    public function transaction()
    {
        return $this->belongsTo(BankTransaction::class,'payment_bank_transaction_id');
    }
    
    public function getAmountAsRialAttribute()
    {
        return $this->attributes['payment_amount'] * 10;
    }
}
