<?php

namespace App\Services\GatewayTransaction\Verifier\Handlers;


use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\GatewayTransaction\Verifier\contracts\Verifier;
use App\Services\GatewayTransaction\Verifier\Exceptions\ResNumberException;

class ResNumberValidator extends Verifier
{

    public function process(TransactionVerifiyRequest $request)
    {
        $gateway_repository = resolve(GatewayTransactionRepositoryInterface::class);
        $gateway = $gateway_repository->findBy(
            [
                'gateway_transaction_res_number' => $request->getResNumber(),
            ]
        );
        if (!$gateway) {
            throw new ResNumberException('invalid ResNumber!');
        }

        return true;
    }
}