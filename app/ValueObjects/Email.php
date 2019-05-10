<?php


namespace App\ValueObjects;


use http\Exception\InvalidArgumentException;

class Email
{
    private $email;
    public function __construct($value)
    {
        if (!filter_var($value,FILTER_VALIDATE_EMAIL))
        {
            throw  new InvalidArgumentException('invalid Email Address');
        }
        $this->email=$value;
    }
    
    public function __toString()
    {
        return (string)$this->email;
    }
}