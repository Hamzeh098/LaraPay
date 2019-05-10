<?php

namespace App\Http\Controllers\Admin\Withdrawal;

use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Services\Withdrawal\Validator\WithdrawalValidator;
use App\Services\Withdrawal\WithdrawalRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    /**
     * @var WithdrawalRepositoryInterface
     */
    private $withdrawal_repository;
    
    public function __construct(WithdrawalRepositoryInterface $withdrawal_repository)
    {
    
        $this->withdrawal_repository = $withdrawal_repository;
    }
    public function index()
    {
        return view('admin.withdrawal.index');
        
    }
    
    public function create()
    {
     $withdrawalItem =null;
     $statuses = $this->withdrawal_repository->getStatuses();
        return view('admin.withdrawal.create',compact('withdrawalItem','statuses'));
    }
    
    public function store(Request $request)
    {
        $gatewayRepository = resolve(GatewayRepositoryInterface::class);
        $gateway_item = $gatewayRepository->findWith($request->gateway,['plan']);
        $gateway_item = $gateway_item->first();
        $withdrawalRequest =  WithdrawalRequest::fromArray(
            [
                'gateway'=>$request->gateway,
                'account'=>$request->account,
                'amount'=>$request->amount,
                'commission'=>$gateway_item->plan->gateway_plan_commission,
                'rate'=>$gateway_item->plan->gateway_plan_withdrawal_rate,
                'max'=>$gateway_item->plan->gateway_plan_withdrawal_max,
                'status'=>$request->status
            ]
        );
        //dd($withdrawalRequest);
        $withdrawalRequestValidator = new WithdrawalValidator();
        $withdrawalRequestValidator->validate($withdrawalRequest);
        
    }
    
    public function delete(Request $request,$id)
    {
    
    }
    
    public function edit(Request $request,$id)
    {
    
    }
    
    public function update(Request $request,$id)
    {
    
    }
}
