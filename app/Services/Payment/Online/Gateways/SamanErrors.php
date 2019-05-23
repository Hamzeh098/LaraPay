<?php


namespace App\Services\Payment\Online\Gateways;


class SamanErrors
{
    public static function getErrors()
    {
        return array(
            "Canceled By User"                => "عملیات پرداخت پول توسط شما لغو شده است.",
            "InvalidAmount"                   => "مبلغ سند برگشتى از مبلغ قابل پرداخت بیشتر است.",
            "InvalidTransaction"              => "درخواست برگشت یک پرداخت رسیده است, درحالى که پرداخت اصلى پیدا نمى شود.",
            "Bad Card Number"                 => "شماره کارت اشتباه مى باشد.",
            "NoSuchIssuer"                    => "چنین صادرکننده کارتى وجود ندارد.",
            "ExpiredCardPickUp"               => "از تاریخ انقضاى کارت گذشته است و کارت دیگر معتبر نیست.",
            "SuspectedCardPickUp"             => "رمز کارت (PIN) به تعداد 4 بار یا بیشتر اشتباه وارد شده است.",
            "AllowablePINTriesExceededPickUp" => "رمز کارت (PIN) 3 مرتبه اشتباه وارد شده است در نتیجه کارت شما غیرفعال خواهد شد.",
            "IncorrectPIN"                    => "شما رمز کارت (PIN)را اشتباه وارد کرده اید.",
            "ExceedsWithdrawalAmountLimit"    => "مبلغ بیش از سقف پرداخت مى باشد.",
            "TransactionCannotBeCompleted"    => "پرداخت Authorize شده است (شماره PIN و PAN درست مى باشند) ولى امکان سند خوردن وجود ندارد.",
            "ResponseReceivedTooLate"         => "تراکنش در شبکه بانکى Timeout خورده است.",
            "SuspectedFraudPickUp"            => "شما یا فیلد مربوط به CVV2 ویا فیلد مربوط به ExpDate را اشتباه وارد کرده اید. (شاید هم اصلا وارد نکرده اید)",
            "NoSufficientFunds"               => "به اندازه کافى موجودى در حساب شما وجود ندارد.",
            "IssuerDownSlm"                   => "سیستم کارت بانک صادرکننده در وضعیت عملیاتى نیست."
        );
    }

    public static function getErrorMessageByStatus(string $status)
    {
        return self::getErrors()[$status];
    }
}