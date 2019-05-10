<?php
namespace App\Repositories\Contracts;

use App\Entities\UserEntity;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function getActiveUser();
    
    public function searchUsers(string $keyword);
    
}