<?php


namespace App\Services\Payment;


use App\Repositories\Contracts\BankTransactionRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Payment\PaymentStatus;
use App\Repositories\Eloquent\Payment\PaymentType;
use App\Services\Payment\Providers\CardToCardPayment;
use App\Services\Payment\Providers\CashPayment;
use App\Services\Payment\Providers\OnlinePayment;
use App\Services\Payment\Providers\PosPayment;
use App\Services\Payment\Providers\WalletPayment;

class PaymentService
{
    private $paymentRepository;

    private $transactionRepository;

    public function __construct()
    {
        $this->paymentRepository = resolve(PaymentRepositoryInterface::class);
        $this->transactionRepository  = resolve(BankTransactionRepositoryInterface::class);
    }

    public function doPayment(int $transaction, int $paymentProvider = PaymentType::ONLINE)
    {
        $transactionItem = $this->transactionRepository->find($transaction);
        $paymentProviderClass = $this->getPaymentProvider($paymentProvider);
        $paymentProviderHandler = new $paymentProviderClass($transactionItem);

        return $paymentProviderHandler->pay();

    }

    public function verifyPayment(array $verifyParams)
    {
        $paymentItem = $this->getPaymentItem($verifyParams['paymentCode']);
        if (!$paymentItem) {
            return [
                'success' => false,
                'message' => 'پرداخت شما معتبر نمی باشد'
            ];
        }
        $paymentProvider = $this->getPaymentProvider($paymentItem->payment_type);
        $paymentProviderInstance = new $paymentProvider($paymentItem->transaction);
        $paymentVerifyResult = $paymentProviderInstance->verify($paymentItem, $verifyParams);
        $paymentUpdateData = [];
        if ($paymentVerifyResult['success']) {
            $paymentUpdateData = [
                'payment_ref_num' => $paymentVerifyResult['ref_num'],//$paymentVerifyResult['trance_num']
//                'payment_trace_number' => $paymentVerifyResult['trance_num'],
//                'payment_paid_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'payment_card_number' => $paymentVerifyResult['card_number'],
                'payment_status' => PaymentStatus::PAID
            ];}
        if (isset($paymentVerifyResult['state'])) {
            $paymentUpdateData['payment_callback_state'] = $paymentVerifyResult['state'];
        }

        $this->paymentRepository->update($paymentItem->payment_id, $paymentUpdateData);

        return $paymentVerifyResult;

    }

    public function checkPayment(array $verifyParams)
    {
        $paymentItem = $this->getPaymentItem($verifyParams['paymentCode']);
        $paymentProvider = $this->getPaymentProvider($paymentItem->payment_type);
        $paymentProviderInstance = new $paymentProvider($paymentItem->transaction);
        return $paymentProviderInstance->checkPayment($paymentItem,$verifyParams);


    }

    private function getPaymentProvider(int $paymentProvider)
    {
        return [
            PaymentType::ONLINE => OnlinePayment::class,
            PaymentType::WALLET => WalletPayment::class,
            PaymentType::CASH => CashPayment::class,
            PaymentType::CARD_TO_CARD => CardToCardPayment::class,
            PaymentType::POS => PosPayment::class
        ][$paymentProvider];
    }

    private function getPaymentItem($paymentCode)
    {
        return $this->paymentRepository->findBy([
            'payment_code' => $paymentCode,
            'payment_status' => PaymentStatus::UNPAID
        ]);
    }

}