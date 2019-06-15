<?php


namespace App\Services\Payment\Providers;


use App\Helpers\Hash\generateHash;
use App\Models\BankTransaction;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Payment\PaymentStatus;
use App\Repositories\Eloquent\Payment\PaymentType;
use App\Services\Payment\Contracts\PaymentMethod;

class OnlinePayment extends PaymentMethod
{
    protected $gateway;
    protected $transaction;
    protected $paymentRepository;
    protected $title;

    public function __construct(BankTransaction $bankTransaction)
    {
        $this->transaction = $bankTransaction;
        $this->paymentRepository = resolve(PaymentRepositoryInterface::class);
        $this->setDefaultGateway();

    }

    public function pay()
    {
        $newPayment = $this->initPayment();
        if ($newPayment) {
            $this->gateway->setPayment($newPayment);

            return $this->gateway->paymentRequest();
        }
    }

    public function verify(Payment $payment, array $verifyParams)
    {
        $providerClass = $this->getProviderByName($payment->payment_gateway);
        $providerInstance = new $providerClass;
        $providerInstance->setPayment($payment);

        return $providerInstance->verifyPayment($verifyParams);
    }

    public function checkPayment(Payment $payment,array $verifyParams)
    {
        $providerClass = $this->getGatewayByName($payment->payment_gateway);
        $providerInstance = new $providerClass;
        $providerInstance->setPayment($payment);
        return $providerInstance->checkPayment($verifyParams);
    }

    protected function initPayment()
    {
        return $this->paymentRepository->store([
            'payment_code' => generateHash::make(16),
            'payment_bank_transaction_id' => $this->transaction->bank_transaction_id,
            'payment_gateway' => $this->gateway->gatewayTitle(),
            'payment_type'  => PaymentType::ONLINE,
            'payment_amount' => $this->transaction->bank_transaction_amount,
            'payment_res_num' => $this->getPaymentResNum(),
            'payment_status' => PaymentStatus::UNPAID
        ]);
    }

    protected function getPaymentResNum()
    {
        return str_replace('.', '', microtime(true)) . mt_rand(9999, 99999);
    }

    private function getGatewayByName(string $provider)
    {
        return 'App\\Services\\Payment\\Online\\Gateways\\' . ucfirst($provider);
    }

    private function setDefaultGateway()
    {
        $defaultGateway = config('gateways.default');
        $defaultGatewayClass = $this->getGatewayByName($defaultGateway);
        $this->gateway = new $defaultGatewayClass;
    }
}