<?php

namespace App\Services\Payment\Online\Contract;


use App\Models\Payment;

interface OnlineGateway
{

    public function paymentRequest();

    public function verifyPayment(array $verifyParams);

    public function gatewayTitle();

    public function setPayment(Payment $payment);

    public function checkPayment(array $verifyParams);

}