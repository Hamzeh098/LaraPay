<?php

namespace App\Http\Controllers\Admin\Gateway;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PlanRepositoryInterface;
use Illuminate\Http\Request;

class GatewayPlanController extends Controller
{
    /**
     * @var PlanRepositoryInterface
     */
    private $plan_repository;
    
    public function __construct(PlanRepositoryInterface $plan_repository)
    {
        $this->plan_repository = $plan_repository;
    }
    
    public function index()
    {
        $planGatewayItem= $this->plan_repository->all();
        return view('admin.gateway.plan.index',compact('planGatewayItem'));
    }
    
    public function create()
    {
        $gatewayPlanItem = null;
        
        return view('admin.gateway.plan.create', compact('gatewayPlanItem'));
    }
    
    public function store(Request $request)
    {
        $newPlan = $this->plan_repository->store(
            [
                'gateway_plan_title'=>$request->input('title'),
                'gateway_plan_commission'=>$request->input('commission'),
                'gateway_plan_withdrawal_rate'=>$request->input('rate'),
                'gateway_plan_withdrawal_max'=>$request->input('withdrawalMax')
            ]
        );
        if ($newPlan)
        {
            return redirect()->back()->with('status','پلن با موفقیت ایجاد شد');
        }
    }
    
    public function delete()
    {
        
    }
    
    public function edit()
    {
        
    }
    
    public function update()
    {
        
    }
}
