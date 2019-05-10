<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\StatisticsRepositoryInterface;
use stdClass;

class dashboardController extends adminController
{
    private $statisticsRepository;
    
    public function __construct(StatisticsRepositoryInterface $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }
    
    
    public function index()
    {
        $statistics = new stdClass();
        $statistics->totalGateway = $this->statisticsRepository->totalGateway();
        $statistics->todayTransaction = $this->statisticsRepository->todayTotalTransaction();
        $statistics->todayWithdrawal = $this->statisticsRepository->todayWithdrawal();
        $statistics->PendingGateway = $this->statisticsRepository->totalPendingGateway();
        return view('admin.dashboard.index',compact('statistics'));
    }
    
    public function statistics()
    {
    
    }
}
