<?php

namespace App\Services\GatewayTransaction;


use App\Services\GatewayTransaction\Validator\TransactionValidator;

class GatewayTransactionService
{
    public function __construct()
    {

    }

    public function make(GatewayTransactionRequest $request)
    {
        $resultValidate = $this->validate($request);
        if ($resultValidate)
        {
            $this->create();
        }

    }

    private function validate(GatewayTransactionRequest $request)
    {
        $validator = new TransactionValidator();
        $validator->validate($request);
    }

    private function create()
    {

    }


}