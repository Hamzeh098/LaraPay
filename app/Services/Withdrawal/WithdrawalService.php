<?php


namespace App\Services\Withdrawal;


use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Services\Withdrawal\Validator\WithdrawalValidator;

class WithdrawalService
{
    private $withdrawal_repository;
    
    public function __construct()
    {
        $this->withdrawal_repository
            = resolve(WithdrawalRepositoryInterface::class);
    }
    
    public function create(WithdrawalRequest $withdrawal_request)
    {
        $withdrawalRequestValidator = new WithdrawalValidator();
        $withdrawalRequestValidator->validate($withdrawal_request);
        
        $newWithdrawal = $this->withdrawal_repository->store(
            [
                'withdrawal_gateway_id'      => $withdrawal_request->getGateway(),
                'withdrawal_user_account_id' => $withdrawal_request->getAccount(),
                'withdrawal_amount'          => $withdrawal_request->getAmount(),
                'withdrawal_commission'      => $withdrawal_request->getCommission(),
                'withdrawal_status'          => $withdrawal_request->getStatus(),
            ]
        );
        
        if ( ! is_null($newWithdrawal)) {
            /*TODO NOtification service*/
            return true;
        }
        
        
    }
    
    public function approve(int $withdrawal_id)
    {
        $this->withdrawal_repository->beginTransaction();
        $result = false;
        try {
            $withdrawalItem
                     = $this->withdrawal_repository->find($withdrawal_id);
            $gateway = $withdrawalItem->gateway;
            // $user = $withdrawalItem->account->owner;
            $gateway->decrement('gateway_balance',
                $withdrawalItem->withdrawal_amount);
            $withdrawalItem->done();
            //update Report
            $this->withdrawal_repository->commit();
            $result = true;
        } catch (\Exception $exception) {
            $this->withdrawal_repository->rollBack();
        }
        
        return $result;
    }
}