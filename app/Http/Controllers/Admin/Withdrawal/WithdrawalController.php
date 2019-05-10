<?php

namespace App\Http\Controllers\Admin\Withdrawal;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Services\Withdrawal\CreateWithdrawalService;
use App\Services\Withdrawal\WithdrawalRequest;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * @var WithdrawalRepositoryInterface
     */
    private $withdrawal_repository;
    private $CreateWithdrawalService;
    
    public function __construct(
        WithdrawalRepositoryInterface $withdrawal_repository
    ) {
        $this->withdrawal_repository   = $withdrawal_repository;
        $this->CreateWithdrawalService = new CreateWithdrawalService();
    }
    
    public function index()
    {
        $withdrawals = $this->withdrawal_repository->all(null,['gateway','account.owner']);
        return view('admin.withdrawal.index',compact('withdrawals'));
        
    }
    
    public function create()
    {
        $withdrawalItem = null;
        $statuses       = $this->withdrawal_repository->getStatuses();
        
        return view('admin.withdrawal.create',
            compact('withdrawalItem', 'statuses'));
    }
    
    public function store(Request $request)
    {
        $gatewayRepository = resolve(GatewayRepositoryInterface::class);
        $gateway_item      = $gatewayRepository->findWith($request->gateway,
            ['plan']);
        $gateway_item      = $gateway_item->first();
        $withdrawalRequest = WithdrawalRequest::fromArray(
            [
                'gateway'    => $request->gateway,
                'account'    => $request->account,
                'amount'     => $request->amount,
                'commission' => $gateway_item->plan->gateway_plan_commission,
                'rate'       => $gateway_item->plan->gateway_plan_withdrawal_rate,
                'max'        => $gateway_item->plan->gateway_plan_withdrawal_max,
                'status'     => $request->status,
            ]
        );
        
        try {
            $result = $this->CreateWithdrawalService->create($withdrawalRequest);
            if ( ! $result) {
                return redirect()->route('admin.withdrawal.index')->withErrors([
                    'error' => 'لطفا بعدا امتحان کنید.',
                ]);
            }
            
            return redirect()->back()->with('status',
                'درخواست شما با موفقیت ثبت گردید');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(
                [
                    'error' => $exception->getMessage(),
                ]
            );
        }
        
    }
    
    public function delete(Request $request, $id)
    {
    
    }
    
    public function edit(Request $request, $id)
    {
    
    }
    
    public function update(Request $request, $id)
    {
    
    }
}
