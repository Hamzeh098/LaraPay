<?php


namespace App\Repositories\Eloquent\Statistics;


use App\Repositories\Contracts\StatisticsRepositoryInterface;

class EloquentStatisticsRepository implements StatisticsRepositoryInterface
{
    
    public function todayWithdrawal()
    {
        return 0;
    }
    
    public function todayTotalTransaction()
    {
        return 0;
    }
    
    public function totalGateway()
    {
        return 0;
    }
    
    
    public function totalPendingGateway()
    {
        return 0;
    }
}