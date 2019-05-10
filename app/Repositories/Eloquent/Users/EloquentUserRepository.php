<?php

namespace App\Repositories\Eloquent\Users;

use App\Models\User;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class EloquentUserRepository extends EloquentBaseRepository implements
    UserRepositoryInterface
{
    
    protected $model = User::class;
    
    public function getActiveUser()
    {
    
    }
    
    public function searchUsers(string $keyword)
    {
        return $this->model::where('name', 'like', "%$keyword%")
                           ->orWhere('email', 'like', "%$keyword%")->get([
                'id',
                'name as text',
            ]);
    }
}