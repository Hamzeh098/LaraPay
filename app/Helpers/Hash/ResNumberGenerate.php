<?php
/**
 * Created by PhpStorm.
 * User: MOHAMMAD
 * Date: 27/05/2019
 * Time: 03:38 PM
 */

namespace App\Helpers\Hash;


class ResNumberGenerate
{
    public static function getPaymentResNum()
    {
        return str_replace('.', '', microtime(true)).mt_rand(9999, 99999);
    }
}