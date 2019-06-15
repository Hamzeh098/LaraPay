<?php
/**
 * Created by PhpStorm.
 * User: MOHAMMAD
 * Date: 26/05/2019
 * Time: 12:42 PM
 */

namespace App\Repositories\Eloquent\Transaction;


class GatewayTransactionStatus
{
    const PENDING = 0;
    const VERITY_WAITING = 1;
    const COMPELETE = 2;
    const FAILED = 3;

    public static function getStatuses()
    {
        return [
            self::PENDING => 'در انتظار پرداخت',
            self::VERITY_WAITING => 'در انتظار تایید',
            self::COMPELETE => 'کامل شده',
            self::FAILED => 'نا موفق'
        ];
    }

}