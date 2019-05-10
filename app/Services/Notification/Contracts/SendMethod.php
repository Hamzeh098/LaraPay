<?php


namespace App\Services\Notification\Contracts;


interface SendMethod
{
    public function send(array $args);
    
}