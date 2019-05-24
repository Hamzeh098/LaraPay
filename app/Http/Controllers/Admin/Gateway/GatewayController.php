<?php

namespace App\Http\Controllers\Admin\Gateway;

use App\Http\Controllers\Controller;
use App\Models\Gateway;
use App\Models\Plan;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Services\Gateway\createGatewayRequest;
use App\Services\Gateway\createGatewayService;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    /**
     * @var GatewayRepositoryInterface
     */
    private $gateway_repository;
    
    public function __construct(GatewayRepositoryInterface $gateway_repository)
    {
        $this->gateway_repository = $gateway_repository;
        
    }
    
    public function index()
    {
        $gatewayItem = $this->gateway_repository->all();
        
        return view('admin.gateway.index', compact('gatewayItem'));
    }
    
    public function create()
    {
        $planRepository = resolve(PlanRepositoryInterface::class);
        $plans          = $planRepository->all();
        $gatewayItem    = null;
        $statuses       = Gateway::getStatuses();
        
        return view('admin.gateway.create',
            compact('gatewayItem', 'statuses', 'plans'));
    }
    
    public function store(Request $request)
    {
        $createGatewayRequest
                    = new createGatewayService(new createGatewayRequest(
            [
                'owner'  => $request->input('owner'),
                'title'  => $request->input('title'),
                'plan'   => $request->input('plan'),
                // 'website'=>$request->input('website'),
                'status' => $request->input('status'),
            ]
        ));
        $newGateway = $createGatewayRequest->perform();
        if ($newGateway) {
            return redirect()->route('admin.gateway.index')
                             ->with('stauts', 'درگاه با موفقیت ایجاد شد');
        }
        
    }
    
    public function edit(Request $request)
    {
        $planRepo = resolve(PlanRepositoryInterface::class);
        $plans       =$planRepo->all();
        $statuses    = Gateway::getStatuses();
        $gatewayItem = $this->gateway_repository->find($request->id);
        
        return view('admin.gateway.edit',
            compact('gatewayItem', 'plans', 'statuses'));
    }
    
    public function update(Request $request, $id)
    {
        $gatewayUpdate = $this->gateway_repository->update($id,
            [
                'gateway_plan'    => $request->input('plan'),
                'gateway_title'   => $request->input('title'),
                'gateway_user_id' => $request->input('owner'),
                // 'website'=>$request->input('website'),
                'gateway_status'  => $request->input('status'),
            ]
        );
        if ($gatewayUpdate) {
            return redirect()->route('admin.gateway.index')
                             ->with('status', 'درگاه با موفقیت ویرایش شد');
        }
    }
    
    public function delete(Request $request, $id)
    {
        $deleteGateway = $this->gateway_repository->delete($id);
        if ($deleteGateway) {
            return redirect()->back()->with('status', 'درگاه با موفقیت حذف شد');
        }
    }
    
    public function search(Request $request)
    {
        $term = $this->gateway_repository->search($request->search);
        
        return response()->json(['items' => $term]);
    }
    
    
}
