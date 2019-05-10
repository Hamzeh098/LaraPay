<?php


namespace App\Repositories\Eloquent\Withdrawal;


use App\Models\WithDrawal;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use Carbon\Carbon;

class EloquentWithdrawalRepository extends EloquentBaseRepository implements
    WithdrawalRepositoryInterface
{
    protected $model = WithDrawal::class;
    
    public function getUserAccountWithdrawalCount(int $userAccountID)
    {
        return $this->model::where('withdrawal_user_account_id',$userAccountID)
            ->whereBetween('created_at',Carbon::now(),Carbon::now()->subMonth(1))
            ->count();
    }
    
    public function getStatuses()
    {
        return $this->model::getStatuses();
    }
}