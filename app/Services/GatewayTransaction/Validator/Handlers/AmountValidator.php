<?php

namespace App\Services\GatewayTransaction\Validator\Handlers;


use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\Validator\contracts\Validator;
use App\Services\GatewayTransaction\Validator\Exceptions\AmountException;

class AmountValidator extends Validator
{

    public function process(GatewayTransactionRequest $request)
    {
        $minAmount = config('transaction.amount.min');
        $maxAmount = config('transaction.amount.max');
        if ($request->getAmount() < $minAmount || $request->getAmount() > $maxAmount) {
            throw  new AmountException('invalid Amount!');
        }
        return true;
    }
}