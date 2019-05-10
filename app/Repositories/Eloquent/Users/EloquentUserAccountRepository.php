<?php


namespace App\Repositories\Eloquent\Users;


use App\Models\UserAccount;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\UserAccountRepositoryInterface;

class EloquentUserAccountRepository extends EloquentBaseRepository implements
    UserAccountRepositoryInterface
{
    protected $model = UserAccount::class;
    
    
    public function search(string $term)
    {
        return $this->model::where('user_account_title', 'LIKE', "%{$term}%")
                           ->get([
                               'user_account_id as id',
                               'user_account_title as text',
                           ]);
    }
    
    
    
}