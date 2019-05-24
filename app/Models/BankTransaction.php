<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    
    protected $primaryKey = 'bank_transaction_id';
    
    protected $guarded = ['bank_transaction_id'];
    
    public function payment()
    {
        return $this->hasMany(Payment::class, 'payment_bank_transaction_id');
    }
}
