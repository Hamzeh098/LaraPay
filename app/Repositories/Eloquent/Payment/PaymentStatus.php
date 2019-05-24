<?php


namespace App\Repositories\Eloquent\Payment;


class PaymentStatus
{
    const PAID = 1;
    const UNPAID = 2;

    public static function getStatuses()
    {
        return [
            self::PAID => 'پرداخت شده',
            self::UNPAID => 'پرداخت نشده'
        ];
    }
}