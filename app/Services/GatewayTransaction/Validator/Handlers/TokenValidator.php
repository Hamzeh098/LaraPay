<?php

namespace App\Services\GatewayTransaction\Validator\Handlers;


use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\Validator\contracts\Validator;
use App\Services\GatewayTransaction\Validator\Exceptions\TokenException;

class TokenValidator extends Validator
{

    public function process(GatewayTransactionRequest $request)
    {
        $gateway_repository = resolve(GatewayRepositoryInterface::class);
        $gateway = $gateway_repository->findBy(
            [
                'access_token' => $request->getToken()
            ]
        );
        if (!$gateway) {
            throw new TokenException('invalid Token!');
        }
        return true;
    }
}