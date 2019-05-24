<?php

namespace App\Services\Payment\Contracts;

abstract class PaymentMethod
{
    abstract protected function pay();

}