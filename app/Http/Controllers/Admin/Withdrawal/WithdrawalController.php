<?php

namespace App\Http\Controllers\Admin\Withdrawal;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Services\Withdrawal\WithdrawalRequest;
use App\Services\Withdrawal\WithdrawalService;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * @var WithdrawalRepositoryInterface
     */
    private $withdrawal_repository;
    private $WithdrawalService;
    
    public function __construct(
        WithdrawalRepositoryInterface $withdrawal_repository
    ) {
        $this->withdrawal_repository = $withdrawal_repository;
        $this->WithdrawalService     = new WithdrawalService();
    }
    
    public function index()
    {
        $withdrawals = $this->withdrawal_repository->all(null,
            ['gateway', 'account.owner']);
        return view('admin.withdrawal.index', compact('withdrawals'));
        
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
            $result
                = $this->WithdrawalService->create($withdrawalRequest);
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
    
    public function approve(Request $request, $id)
    {
        $withdrawalItem = $this->getById($id);
        
        return view('admin.withdrawal.approve', compact('withdrawalItem'));
    }
    
    public function performApprove(Request $request, $id )
    {
        $resultApprove = $this->WithdrawalService->approve($id,$request->ref_number);
        if ($resultApprove) {
            return redirect()->route('admin.withdrawal.index')
                             ->with('status', 'درخواست با موفقیت انجام شد!');
        }
        
        return redirect()->back()->withErrors([
            'error' => 'درخواست با مشکل مواجه شد لطفا بعدا امتحان کنید',
        ]);
    }
    
    public function reject(Request $request, $id)
    {
        $resultReject = $this->WithdrawalService->reject($id);
        if ($resultReject)
        {
            return redirect()->back()->with('status','درخواست با موفقیت اجرا شد');
        }
        return redirect()->back()->withErrors([
           'error'=>'درخواست با موفقیت حذف شد'
        ]);
        
        
    }
    
    private function getById($id)
    {
        $WithdrawalItem = $this->withdrawal_repository->find($id);
        if ( ! $WithdrawalItem) {
            abort(404);
        }
        
        return $WithdrawalItem;
    }
    
    
}
