<?php


namespace App\Entities;


use App\Models\User;

class EloquentUserEntity implements UserEntity
{
    /**
     * @var User
     */
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function getName()
    {
        return $this->user->name;
    }
    
    public function getEmail()
    {
        
        return $this->user->email;
    }
    
    public function getMobile()
    {
        return $this->user->mobile;
    }
}