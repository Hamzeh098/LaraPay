<?php

namespace App\Services\GatewayTransaction\Validator\Handlers;


use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\Validator\contracts\Validator;
use App\Services\GatewayTransaction\Validator\Exceptions\ResNumberException;

class ResNumberValidator extends Validator
{

    public function process(GatewayTransactionRequest $request)
    {
        if (strlen($request->getResNumber()) < 20) {
            throw new ResNumberException('invalid Resnumber!');
        }

        return true;
    }
}