<?php


namespace App\Services\Withdrawal\Validator\Handlers;


use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Services\Withdrawal\Validator\Contracts\Validator;
use App\Services\Withdrawal\Validator\Exceptions\WithdrawalGatewayBalanceException;
use App\Services\Withdrawal\WithdrawalRequest;

class WithdrawalGatewayBalanceValidator extends Validator
{
    
    private $gateway_repository;
    
    public function __construct()
    {
        $this->gateway_repository = resolve(GatewayRepositoryInterface::class);
    }
    
    public function process(WithdrawalRequest $request)
    {
        $gateway = $this->gateway_repository->find($request->getGateway());
        if ($request->getAmount() >  $gateway->gateway_balance)
        {
            throw new WithdrawalGatewayBalanceException('مبلغ درخواستی بیشتر از موجودی درگاه میباشد!');
        }
        return true;
    }
}