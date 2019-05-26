<?php

namespace App\Http\Controllers\Frontend\Transaction;

use App\Services\GatewayTransaction\GatewayTransactionRequest;
use App\Services\GatewayTransaction\GatewayTransactionService;
use http\Env\Response;
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
        try {

            $transactionKey = $this->gatewayTransactionService->make(new GatewayTransactionRequest([
                'token' => $request->token,
                'amount' => $request->amount,
                'res_number' => $request->res_number,
                'ip' => $request->ip(),
                'domain' => $request->getHost(),
                'description' => ''
            ]));
            return response()->json([
                'success' => true,
                'transactionKey' => $transactionKey
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }


    }
}
