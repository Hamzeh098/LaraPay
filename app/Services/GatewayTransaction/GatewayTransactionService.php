<?php

namespace App\Services\GatewayTransaction;


use App\Helpers\Hash\generateHash;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Repositories\Eloquent\Transaction\GatewayTransactionStatus;
use App\Services\GatewayTransaction\Validator\TransactionValidator;

class GatewayTransactionService
{
    private $gateway_repository;
    private $gateway_transaction_repository;

    public function __construct()
    {
        $this->gateway_transaction_repository = resolve(GatewayTransactionRepositoryInterface::class);
        $this->gateway_repository = resolve(GatewayRepositoryInterface::class);
    }

    public function make(GatewayTransactionRequest $request)
    {
        $resultValidate = $this->validate($request);
        if ($resultValidate) {
            return $this->create($request);
        }

    }

    private function validate(GatewayTransactionRequest $request)
    {
        $validator = new TransactionValidator();
        return $validator->validate($request);
    }

    private function create(GatewayTransactionRequest $request)
    {
        $gateway = $this->gateway_repository->findBy([
            'access_token' => $request->getToken()
        ]);
        $transactionKey = generateHash::make(30);
        $newTransaction = $this->gateway_transaction_repository->store([
            'gateway_transaction_amount' => $request->getAmount(),
            'gateway_transaction_key' => $transactionKey,
            'gateway_transaction_res_number' => $request->getResNumber(),
            'gateway_transaction_description' => $request->getDescription(),
            'gateway_transaction_status' => GatewayTransactionStatus::PENDING
        ]);
        if ($newTransaction) {
            return $transactionKey;
        }
        return null;

    }


}