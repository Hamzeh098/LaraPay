<?php


namespace App\Services\Withdrawal\Validator\Handlers;


use App\Services\Withdrawal\Validator\Contracts\Validator;
use App\Services\Withdrawal\Validator\Exceptions\WithdrawalAmountlimitException;
use App\Services\Withdrawal\WithdrawalRequest;

class WithdrawalMaxAmountValidator extends Validator
{
    
    public function process(WithdrawalRequest $request)
    {
        $maxAmount = $request->getMaxAmount();
        if (intval($request->getAmount() > $maxAmount)) {
            throw  new WithdrawalAmountlimitException('مبلغ درخواستی بیشتر از حد مجاز می باشد.');
        }
        
        return true;
    }
}