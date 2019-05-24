<?php


namespace App\Services\GatewayTransaction\Validator;


use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\Validator\Handlers\AmountValidator;
use App\Services\GatewayTransaction\Validator\Handlers\DomainValidator;
use App\Services\GatewayTransaction\Validator\Handlers\ResNumberValidator;
use App\Services\GatewayTransaction\Validator\Handlers\TokenValidator;

class TransactionValidator
{
    public function __construct()
    {

    }

    public function validate(GatewayTransactionRequest $request)
    {
        $resNumValidator = new ResNumberValidator();
        $DomainValidator = new DomainValidator($resNumValidator);
        $amountValidaton = new AmountValidator($DomainValidator);
        $tokenValidator = new TokenValidator($amountValidaton);
        return $tokenValidator->handle($request);
    }
}