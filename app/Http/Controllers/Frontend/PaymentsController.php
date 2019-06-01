<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BankTransactionRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Transaction\BankTransactionStatus;
use App\Repositories\Eloquent\Transaction\GatewayTransactionStatus;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * @var PaymentService
     */
    private $payment_service;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    public function __construct(
        PaymentService $payment_service,
        PaymentRepositoryInterface $paymentRepository
    ) {

        $this->payment_service = $payment_service;
        $this->paymentRepository = $paymentRepository;
    }

    public function start()
    {
        return $this->payment_service->doPayment(1);
    }

    public function verify(Request $request, $payment_code)
    {
        $params = $request->all();
        $params['paymentCode'] = $payment_code;
        $payment = $this->paymentRepository->findBy([
            'payment_code' => $payment_code,
        ]);
        if (!$payment) {
            abort(404);
        }
        $transaction = $payment->transaction;
        $transaction->updateCallBackData($params);
        $checkPaymentStatus = $this->payment_service->checkPayment($params);
        $gatewayUpdate = [];
        $bankUpdate = [];
        if ($checkPaymentStatus) {
            $gatewayUpdate
                = [
                'gateway_transaction_status' => GatewayTransactionStatus::VERITY_WAITING,
            ];
            $bankUpdate = [
                'bank_transaction_status' => BankTransactionStatus::VERITY_WAITING,
            ];
        } else {
            $gatewayUpdate
                = [
                'gateway_transaction_status' => GatewayTransactionStatus::FAILED,
            ];
            $bankUpdate = [
                'bank_transaction_status' => BankTransactionStatus::FAILED,
            ];
        }
        $transaction->update($bankUpdate);
        $payment->transaction->gateway_transaction->update($gatewayUpdate);
        $callBackData
            = [
            'callbackUrl'   => $transaction->gateway_transaction->gateway_transaction_callback_url,
            'transactonKey' => $transaction->gateway_transaction->gateway_transaction_key,
            'amount'        => $transaction->gateway_transaction->gateway_transaction_amount,
            'resNumber'     => $transaction->gateway_transaction->gateway_transaction_res_number,
            'status'        => $checkPaymentStatus ? 'OK' : 'FAILED',
        ];

        return view('transaction.payment-callback', compact('callBackData'));
    }


}
