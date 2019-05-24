<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BankTransactionRepositoryInterface;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * @var PaymentService
     */
    private $payment_service;
    private $bank_transaction_repo;
    
    public function __construct(PaymentService $payment_service)
    {
        
        $this->payment_service = $payment_service;
        $this->bank_transaction_repo
                               = resolve(BankTransactionRepositoryInterface::class);
    }
    
    public function start()
    {
         return $this->payment_service->doPayment(1);
    }
    
    public function verify(Request $request)
    {
        dd($request->all());
    }
}
