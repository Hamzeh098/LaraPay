<?php


namespace App\Services\Notification;


use App\Services\Notification\Exepction\NotificationNotFountClassProvider;
use mysql_xdevapi\Exception;

class NotificationService
{
    public function send(array $args)
    {
        $provider = $args['type'];
        $providerHandler = $this->getProvider($provider);
        $providerHandler->send($args);
        
    }
    
    public function getProvider(int $type)
    {
        $provider = null;
        $providerType = NotificationType::getTypeHandler($type);
        $baseNameSpaceProvider = ucfirst(strtolower($providerType));
        $providerClass = 'App\\Services\\Notification\\Providers\\'.$baseNameSpaceProvider.'\\'.$baseNameSpaceProvider.'Provider';
        if (!class_exists($providerClass))
        {
            new NotificationNotFountClassProvider('not found provider exist');
        }
        $provider = new $providerClass;
        
        return $provider;
        
        
    }
}