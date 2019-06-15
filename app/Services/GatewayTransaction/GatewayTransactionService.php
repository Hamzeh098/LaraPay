<?php

namespace App\Services\GatewayTransaction;


use App\Helpers\Hash\generateHash;
use App\Repositories\Contracts\BankTransactionRepositoryInterface;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Repositories\Eloquent\Transaction\BankTransactionStatus;
use App\Repositories\Eloquent\Transaction\GatewayTransactionStatus;
use App\Services\Gateway\AggregtionService;
use App\Services\GatewayTransaction\Validator\TransactionValidator;
use App\Services\GatewayTransaction\Verifier\VerifierValidator;
use App\Services\Payment\PaymentService;

class GatewayTransactionService
{
    private $gateway_repository;
    private $gateway_transaction_repository;
    private $bank_transaction_repository;

    public function __construct()
    {
        $this->gateway_transaction_repository
            = resolve(GatewayTransactionRepositoryInterface::class);
        $this->gateway_repository = resolve(GatewayRepositoryInterface::class);
        $this->bank_transaction_repository
            = resolve(BankTransactionRepositoryInterface::class);
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
            'access_token' => $request->getToken(),
        ]);
        $transactionKey = generateHash::make(30);
        $newTransaction = $this->gateway_transaction_repository->store([
            'gateway_transaction_gateway_id'   => $gateway->gateway_id,
            'gateway_transaction_amount'       => $request->getAmount(),
            'gateway_transaction_key'          => $transactionKey,
            'gateway_transaction_res_number'   => $request->getResNumber(),
            'gateway_transaction_description'  => $request->getDescription(),
            'gateway_transaction_callback_url' => $request->getCallBackUrl(),
            'gateway_transaction_status'       => GatewayTransactionStatus::PENDING,
        ]);
        if ($newTransaction) {
            return $transactionKey;
        }

        return null;

    }

    public function verify(TransactionVerifiyRequest $request)
    {
        //TODO Validation
        $transactionKey = $request->getTransactionKey();
        $amount = $request->getAmount();
        $resNumber = $request->getResNumber();

        $gateway_transaction = $this->gateway_transaction_repository->findBy([
            'gateway_transaction_key' => $transactionKey,
        ]);
        if (!$gateway_transaction) {
            abort(404);
        }

        $transaction = $gateway_transaction->bank_transaction;
        $transactionData = $transaction->bank_transaction_callback_data;

        $paymentService = new PaymentService();
        $paymentVerifyResult = $paymentService->verifyPayment($transactionData);
        $result = [];
        if (!$paymentVerifyResult['success']) {
            $this->bank_transaction_repository->update($transaction->bank_transaction_id,
                ['bank_transaction_status' => BankTransactionStatus::FAILED]);
            $this->gateway_transaction_repository->update($gateway_transaction->gateway_transaction_id,
                ['gateway_transaction_status' => GatewayTransactionStatus::FAILED]);
            $result = [
                'success' => false,
            ];
        } else {
            $aggregationService = new AggregtionService();
            $aggregationService->deposit($gateway_transaction->gateway_transactions_gateway_id,
                $gateway_transaction->gateway_transaction_amount);
            $this->bank_transaction_repository->update($transaction->bank_transaction_id,
                [
                    'bank_transaction_ref_number' => $paymentVerifyResult['ref_number'],
                    'bank_transaction_status'     => BankTransactionStatus::COMPELETE,
                ]);
            $this->gateway_transaction_repository->update($gateway_transaction->gateway_transaction_id,
                [
                    'gateway_transaction_ref_number' => $paymentVerifyResult['ref_number'],
                    'gateway_transaction_status'     => GatewayTransactionStatus::COMPELETE,
                ]);
            $this->gateway_repository->incrBalance($gateway_transaction->gateway_transactions_gateway_id,
                $gateway_transaction->gateway_transaction_amount);
            $result = [
                'success'    => true,
                'ref_number' => $paymentVerifyResult['ref_number'],
            ];
        }

        return $result;

    }


}