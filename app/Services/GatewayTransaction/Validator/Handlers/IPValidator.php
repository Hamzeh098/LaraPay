<?php

namespace App\Services\GatewayTransaction\Validator\Handlers;


use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\Validator\contracts\Validator;
use App\Services\GatewayTransaction\Validator\Exceptions\IPException;

class IPValidator extends Validator
{

    public function process(GatewayTransactionRequest $request)
    {
        $gateway_repo = resolve(GatewayRepositoryInterface::class);
        $gateway = $gateway_repo->findBy(
            [
                'access_token' => $request->getToken()
            ]
        );
        if ($gateway->ip_gateway !== $request->getIp()) {
            throw new IPException('invalid IP Address');
        }
        return true;
    }
}