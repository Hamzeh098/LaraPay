<?php


namespace App\Services\Gateway;


use App\Repositories\Contracts\GatewayAggregationRepositoryInterface;
use Carbon\Carbon;

class AggregtionService
{
    private $gateway_aggregation_repository;
    
    public function __construct()
    {
        $this->gateway_aggregation_repository
            = resolve(GatewayAggregationRepositoryInterface::class);
    }
    
    public function deposit(int $gateway, int $amount, Carbon $date = null)
    {
        $aggregationItem = $this->getAggregation($gateway, $date);
        $aggregationItem->increment('gateway_report_desposit', $amount);
    }
    
    public function withdrawal(int $gateway, int $amount, Carbon $date = null)
    {
        $aggregationItem = $this->getAggregation($gateway, $date);
        $aggregationItem->increment('gateway_report_withdrawal', $amount);
    }
    
    private function getAggregation(int $gateway, Carbon $date = null)
    {
        $aggregationDate = is_null($date) ? Carbon::now() : $date;
        $aggregationItem
                         = $this->gateway_aggregation_repository->existAggregation($gateway,
            $aggregationDate->format("Y-m-d"));
        if (is_null($aggregationItem)) {
            $aggregationItem = $this->gateway_aggregation_repository->store(
                [
                    'gateway_report_gateway_id' => $gateway,
                    'gateway_report_date'       => $aggregationDate->format("Y-m-d"),
                ]
            );
        }
        
        return $aggregationItem;
    }
}