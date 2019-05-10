<?php


namespace App\ValueObjects;



use http\Exception\InvalidArgumentException;

class Mobile
{
    private $mobile;
    
    public function __construct(string $mobile)
    {
    
        $this->setMobile($mobile);
    }
    
    public function setMobile(string $mobile)
    {
        if (!preg_match('((09)(10|11|12|13|14|15|16|17|18|19|30|31|32|33|34|35|36|37|38|39|90)[0-9]{7})',$mobile))
        {
            throw  new \Exception('invalid mobile ');
        }
        $this->mobile = $mobile;
        
    }
    
    public function __toString()
    {
        return (string)$this->mobile;
    }
    
}