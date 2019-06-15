<?php


namespace App\Services\GatewayTransaction\Verifier\Handlers;


use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\GatewayTransaction\Verifier\contracts\Verifier;
use App\Services\GatewayTransaction\Verifier\Exceptions\TimeOutException;
use App\Services\GatewayTransaction\Verifier\Exceptions\TransactionKeyException;
use Carbon\Carbon;

class TimeOutValidator extends Verifier
{

    public function process(TransactionVerifiyRequest $request)
    {
        $timeout = config('transaction.verify.timeout');
        $transactinRepository
            = resolve(GatewayTransactionRepositoryInterface::class);
        $transaction = $transactinRepository->findBy([
            'gateway_transaction_key' => $request->getTransactionKey(),
        ]);
        if (is_null($transaction)) {
            throw new TransactionKeyException('invalid transaction!');
        }
        $now = Carbon::now();
        $timeoutTransaction = $now->diffInMinutes($transaction->updated_at);
        if ($timeout < $timeoutTransaction) {
            throw new TimeOutException('transaction timed Out!');
        }

        return true;
    }
}