<?php


namespace App\Services\Notification;


class NotificationType
{
    const SMS = 1;
    const EMAIL = 2;
    const SOCKET = 3;
    
    public static function getTypes()
    {
        return [
            self::SMS    => 'پیامک',
            self::EMAIL  => 'ایمیل',
            self::SOCKET => 'سوکت',
        ];
    }
    
    public static function getTypeHandler(int $type)
    {
        return[
        self::SMS=>'SMS',
        self::EMAIL=>'EMAIL',
        self::SOCKET=>'SOCKET',
        ];
        
    }
    
    
}