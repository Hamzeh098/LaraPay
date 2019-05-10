<?php


namespace App\Services\User;


use App\Events\User\UserRegistered;
use App\Repositories\Contracts\UserRepositoryInterface;
use phpDocumentor\Reflection\Types\This;
use App\Services\Notification\Facade\Notification;

class UserCreateService
{
    /**
     * @var array
     */
    private $userData;
    /**
     * @var UserRepositoryInterface
     */
    private $user_repository;
    
    public function __construct(array $userData)
    {
        
        $this->userData = $userData;
        
        $this->user_repository = resolve(UserRepositoryInterface::class);
    }
    
    public function perform()
    {
        $newUser = $this->user_repository->store([
            'name'     => $this->userData['name'],
            'email'    => $this->userData['email'],
            'password' => $this->userData['password'],
        ]);
        if (intval($newUser->id)) {
            event(new UserRegistered($newUser));
            
            return true;
        }
        
        return false;
        
    }
    
}