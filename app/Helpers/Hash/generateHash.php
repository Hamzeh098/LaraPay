<?php


namespace App\Helpers\Hash;


class generateHash
{
    
    public static function make($length =10)
    {
        return bin2hex(random_bytes($length/2));
    }
}