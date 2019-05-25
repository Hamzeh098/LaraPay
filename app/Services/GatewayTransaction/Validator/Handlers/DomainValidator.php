<?php

namespace App\Services\GatewayTransaction\Validator\Handlers;


use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\Validator\contracts\Validator;
use App\Services\GatewayTransaction\Validator\Exceptions\DomainExceptions;

class DomainValidator extends Validator
{

    public function process(GatewayTransactionRequest $request)
    {
        $gateway_repo = resolve(GatewayRepositoryInterface::class);
        $gateway = $gateway_repo->findBy(
            ['access_token' => $request->getToken()]
        );
        if ($gateway->domain !== $request->getDomain()) {
            throw new DomainExceptions('invalid Domain!');
        }
        return true;
    }
}