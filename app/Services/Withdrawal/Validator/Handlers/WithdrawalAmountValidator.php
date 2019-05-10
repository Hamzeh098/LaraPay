<?php


namespace App\Services\Withdrawal\Validator\Handlers;


use App\Services\Withdrawal\Validator\Contracts\Validator;
use App\Services\Withdrawal\Validator\Exceptions\WithdrawalAmountlimitException;
use App\Services\Withdrawal\WithdrawalRequest;

class WithdrawalAmountValidator extends Validator
{
    
    public function process(WithdrawalRequest $request)
    {
        $minAmount = config('Constans.withdrawal.limitAmount');
        if (intval($request->getAmount() < $minAmount)) {
            throw  new WithdrawalAmountlimitException('مبلغ درخواستی کمتر از مبلغ تعیین شده می باشد.');
        }
        
        return true;
    }
}