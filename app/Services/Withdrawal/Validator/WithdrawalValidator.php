<?php


namespace App\Services\Withdrawal\Validator;


use App\Services\Withdrawal\Validator\Handlers\WithdrawalAmountValidator;
use App\Services\Withdrawal\Validator\Handlers\WithdrawalCountLimitValidator;
use App\Services\Withdrawal\Validator\Handlers\WithdrawalGatewayBalanceValidator;
use App\Services\Withdrawal\Validator\Handlers\WithdrawalMaxAmountValidator;
use App\Services\Withdrawal\WithdrawalRequest;

class WithdrawalValidator
{
    public function __construct()
    {
        
   }
    public function validate(WithdrawalRequest $request)
    {
        $limitCountValidator = new WithdrawalCountLimitValidator();
        $amountlimitValidator = new WithdrawalAmountValidator($limitCountValidator);
        $maxAmountValidator = new WithdrawalMaxAmountValidator($amountlimitValidator);
        $gatewayBalanceValiditor = new WithdrawalGatewayBalanceValidator($maxAmountValidator);
        return $gatewayBalanceValiditor->handle($request);
    }
}