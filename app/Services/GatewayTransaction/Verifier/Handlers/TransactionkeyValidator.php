<?php

namespace App\Services\GatewayTransaction\Verifier\Handlers;


use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Repositories\Eloquent\Transaction\GatewayTransactionStatus;
use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\GatewayTransaction\Verifier\contracts\Verifier;
use App\Services\GatewayTransaction\Verifier\Exceptions\TransactionKeyException;

class TransactionkeyValidator extends Verifier
{

    public function process(TransactionVerifiyRequest $request)
    {
        $gateway_repository = resolve(GatewayTransactionRepositoryInterface::class);
        $gateway = $gateway_repository->findBy(
            [
                'gateway_transaction_key'    => $request->getTransactionKey(),
                'gateway_transaction_status' => GatewayTransactionStatus::VERITY_WAITING,
            ]
        );
        if (!$gateway) {
            throw new TransactionKeyException('invalid TransactionKey!');
        }
        return true;
    }
}