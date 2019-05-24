<?php


namespace App\Helpers\Currency;


use App\Helpers\Format\Number;

class PersianCurrency
{
    public static function toman($amount)
    {
        return Number::persianNumbers(number_format($amount)) .' تومان ';
    }
}