<?php

namespace App\Http\Controllers\Frontend\Transaction;

use App\Services\GatewayTransaction\GatewayTransactionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionsController extends Controller
{
    /**
     * @var GatewayTransactionService
     */
    private $gatewayTransactionService;

    public function __construct(GatewayTransactionService $gatewayTransactionService)
    {

        $this->gatewayTransactionService = $gatewayTransactionService;
    }

    public function request(Request $request)
    {

    }
}
