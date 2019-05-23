<?php


namespace App\Repositories\Eloquent\Gateway;


use App\Models\GatewayReport;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\GatewayAggregationRepositoryInterface;

class EloquentGatewayAggregationRepository extends
    EloquentBaseRepository implements GatewayAggregationRepositoryInterface
{
    protected $model = GatewayReport::class;
    
    public function existAggregation($gateway,$date)
    {
        return $this->model::where('gateway_report_gateway_id', $gateway)
                           ->whereDate('gateway_report_date', $date)->first();
    }
}