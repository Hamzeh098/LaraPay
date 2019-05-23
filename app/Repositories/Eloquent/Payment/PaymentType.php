<?php


namespace App\Repositories\Eloquent\Payment;


class PaymentType
{
    const ONLINE = 1;
    const WALLET = 2;
    const CASH = 3;
    const POS = 4;
    const CARD_TO_CARD = 5;

    public static function getTypes()
    {
        return [
            self::ONLINE => 'آنلاین',
            self::WALLET => 'کیف پول',
            self::CASH => 'نقدی',
            self::POS => 'کارت خوان',
            self::CARD_TO_CARD => 'کارت به کارت'
        ];
    }

    public static function getType(int $type)
    {
        $types = self::getTypes();
        return $types[$type];
    }
}