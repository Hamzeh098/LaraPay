<?php


namespace App\Helpers\Hash;


class generateHash
{
    
    public static function make($length =15)
    {
        return bin2hex(random_bytes($length/2));
    }
}