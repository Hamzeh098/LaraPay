<?php


namespace App\Services\Notification\Facade;


use Illuminate\Support\Facades\Facade;

class Notification extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'notificaton';
    }
    
}