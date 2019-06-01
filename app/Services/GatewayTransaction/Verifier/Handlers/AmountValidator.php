<?php

namespace App\Services\GatewayTransaction\Verifier\Handlers;


use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\GatewayTransaction\Verifier\contracts\Verifier;
use App\Services\GatewayTransaction\Verifier\Exceptions\AmountException;

class AmountValidator extends Verifier
{

    public function process(TransactionVerifiyRequest $request)
    {
        $gateway_repository
            = resolve(GatewayTransactionRepositoryInterface::class);
        $gateway = $gateway_repository->findBy(
            [
                'gateway_transaction_key' => $request->getTransactionKey(),
                'gateway_transaction_amount' => $request->getAmount(),
            ]
        );
        if (!$gateway) {
            throw new AmountException('invalid Amount');
        }

        return true;
    }
}