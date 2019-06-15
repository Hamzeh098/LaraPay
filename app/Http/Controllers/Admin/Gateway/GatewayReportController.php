<?php

namespace App\Http\Controllers\Admin\Gateway;

use App\Repositories\Contracts\GatewayAggregationRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GatewayReportController extends Controller
{
    /**
     * @var GatewayAggregationRepositoryInterface
     */
    private $gateway_aggregation_repository;
    
    public function __construct(GatewayAggregationRepositoryInterface $gateway_aggregation_repository)
    {
    
        $this->gateway_aggregation_repository = $gateway_aggregation_repository;
    }
    
    public function index()
    {
        $reports = $this->gateway_aggregation_repository->all(null,['gateway.owner']);
        return view('admin.gateway.report.index',compact('reports'));
    }
}
