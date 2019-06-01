<?php


namespace App\Services\GatewayTransaction\Verifier;

use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\GatewayTransaction\Verifier\Handlers\AmountValidator;
use App\Services\GatewayTransaction\Verifier\Handlers\ResNumberValidator;
use App\Services\GatewayTransaction\Verifier\Handlers\TimeOutValidator;
use App\Services\GatewayTransaction\Verifier\Handlers\TokenValidator;
use App\Services\GatewayTransaction\Verifier\Handlers\TransactionkeyValidator;

class VerifierValidator
{

    public function validate(TransactionVerifiyRequest $request)
    {
        $amountValidator = new AmountValidator();
        $resnumberValidator = new ResNumberValidator($amountValidator);
        $transactionKeyValidator
            = new TransactionkeyValidator($resnumberValidator);
        $timeoutValidator = new TimeOutValidator($transactionKeyValidator);
        $tokenValidator = new TokenValidator($timeoutValidator);

        return $tokenValidator->process($request);
    }
}