<?php


namespace App\Services\Payment\Online\Gateways;


use App\Models\Payment;
use App\Services\Payment\Online\Contract\OnlineGateway;

class Saman implements OnlineGateway
{
    
    private $merchant;
    private $username;
    private $password;
    private $title;
    private $paymentItem;
    
    public function __construct()
    {
        $this->merchant = config('gateways.saman.merchant');
        $this->username = config('gateways.saman.username');
        $this->password = config('gateways.saman.password');
        $this->title    = 'saman';
    }
    
    public function paymentRequest()
    {
        $samanData = [
            'merchant' => $this->merchant,
            'amount'   => $this->paymentItem->amount_as_rial,
            'res_num'  => $this->paymentItem->payment_res_num,
            'callback' => route('frontend.payment.verify',
                [$this->paymentItem->payment_code]),
        ];
        
        return view('payment.saman.redirect', compact('samanData'));
    }
    
    public function verifyPayment(array $verifyParams)
    {
        if ( ! isset($verifyParams['State'])) {
            return [
                'success' => false,
                'message' => 'اطلاعات پرداخت نامعتبر می باشد.',
            ];
        }
        if ($verifyParams['State'] != 'OK') {
            return [
                'success' => false,
                'message' => 'پرداخت شما نا موفق بود.',
                'state'   => $verifyParams['State'],
            ];
        }
        $soapClient
                     = new \SoapClient('https://sep.shaparak.ir/payments/referencepayment1.asmx?WSDL');
        $samanVerify = $soapClient->VerifyTransaction($verifyParams['RefNum'],
            $this->merchant);
        if ($samanVerify <= 0) {
            return [
                'success'          => false,
                'message'          => 'پرداخت شما نا موفق بود.',
                'state'            => $verifyParams['State'],
                'errorCodeMessage' => SamanErrors::getErrorMessageByStatus($verifyParams['State']),
            ];
        }
        if ((int) $samanVerify !== (int) $this->paymentItem->amount_as_rial) {
            
            $reverseResult = $soapClient->‫‪reverseTransaction‬‬(
                $verifyParams['RefNum'],
                $this->merchant,
                $this->username,
                $this->password
            );
            
            return [
                'success' => false,
                'message' => 'مبلغ پرداختی شما با مبلغ سفارش مغایرت دارد.',
            ];
        }
        
        return [
            'success'     => true,
            'ref_num'     => $verifyParams['RefNum'],
            'trance_num'  => $verifyParams['TRACENO'],
            'card_number' => $verifyParams['SecurePan'],
            'amount'      => $this->paymentItem->htmlPresent()->paymentAmount,
            'message'     => 'پرداخت شما با موفقیت انجام شد',
            'state'       => $verifyParams['State'],
        ];
        
    }
    
    public function gatewayTitle()
    {
        return $this->title;
    }
    
    public function setPayment(Payment $payment)
    {
        $this->paymentItem = $payment;
    }
    
    public function checkPayment(array $verifyParams)
    {
        return isset($verifyParams['State']) && $verifyParams['State'] == 'OK';
    }
}