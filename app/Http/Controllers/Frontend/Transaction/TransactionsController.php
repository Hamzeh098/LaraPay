<?php

namespace App\Http\Controllers\Frontend\Transaction;

use App\Helpers\Hash\ResNumberGenerate;
use App\Repositories\Contracts\BankTransactionRepositoryInterface;
use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;
use App\Repositories\Eloquent\Transaction\BankTransactionStatus;
use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\GatewayTransactionService;
use App\Services\GatewayTransaction\TransactionVerifiyRequest;
use App\Services\Payment\PaymentService;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionsController extends Controller
{
    /**
     * @var GatewayTransactionService
     */
    private $gatewayTransactionService;
    /**
     * @var GatewayTransactionRepositoryInterface
     */
    private $gatewayTransactionRepository;

    public function __construct(
        GatewayTransactionRepositoryInterface $gatewayTransactionRepository
    ) {

        $this->gatewayTransactionService = new GatewayTransactionService();
        $this->gatewayTransactionRepository = $gatewayTransactionRepository;
    }

    public function request(Request $request)
    {
        try {
            $transactionKey = $this->gatewayTransactionService->make(
                new GatewayTransactionRequest(
                    [
                        'token'       => $request->token,
                        'amount'      => $request->amount,
                        'res_number'  => $request->res_number,
                        'callbackUrl' => $request->callbackurl,
                        'ip'          => $request->ip(),
                        'domain'      => $request->getHost(),
                        'description' => '',
                    ]
                )
            );

            return response()->json(
                [
                    'success'        => true,
                    'transactionKey' => $transactionKey,
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ]
            );
        }
    }

    public function start(Request $request)
    {
        $transactionKey = $request->transactionKey;
        $transaction = $this->gatewayTransactionRepository->findBy(
            [
                'gateway_transaction_key' => $transactionKey,
            ]
        );
        if (is_null($transaction)) {
            abort(404);
        }
        $bankTransaction = resolve(BankTransactionRepositoryInterface::class);
        $newBankTransaction = $bankTransaction->store(
            [
                'bank_transaction_bank_id'                => 0,
                'bank_transaction_res_number'             => ResNumberGenerate::getPaymentResNum(),
                'bank_transaction_amount'                 => $transaction->gateway_transaction_amount,
                'bank_transaction_gateway_transaction_id' => $transaction->gateway_transaction_id,
                'bank_transaction_status'                 => BankTransactionStatus::PENDING,
            ]
        );
        if ($bankTransaction) {
            $peyment = new PaymentService();

            return $peyment->doPayment(
                $newBankTransaction->bank_transaction_id
            );
        }
    }

    public function verify(Request $request)
    {
        $this->gatewayTransactionRepository->beginTransaction();
        try {
            $verifyResult
                = $this->gatewayTransactionService->verify(new TransactionVerifiyRequest(
                [
                    'token'          => $request->token,
                    'transactionKey' => $request->transactionKey,
                    'amount'         => $request->amount,
                    'res_number'     => $request->res_number,
                ]
            ));
            $this->gatewayTransactionRepository->commit();

            return response()->json($verifyResult);
        } catch (\Exception $exception) {
            $this->gatewayTransactionRepository->rollBack();

            return response()->json(
                [
                    'verify'  => false,
                    'messege' => $exception->getMessage(),
                ]
            );
        }


    }

}
