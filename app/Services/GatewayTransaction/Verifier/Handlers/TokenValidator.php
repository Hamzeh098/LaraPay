<?php

namespace App\Services\GatewayTransaction\Verifier\Handlers;




use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\GatewayTransaction\Verifier\Exceptions\TokenException;

class TokenValidator extends Validator
{

    public function process(TransactionVerifiyRequest $request)
    {
        $gateway_repository = resolve(GatewayRepositoryInterface::class);
        $gateway = $gateway_repository->findBy(
            [
                'access_token' => $request->getToken(),
            ]
        );
        if (!$gateway) {
            throw new TokenException('invalid Token!');
        }
        return true;
    }
}