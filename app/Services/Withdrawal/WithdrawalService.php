<?php


namespace App\Services\Withdrawal;


use App\Models\WithDrawal;
use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Services\Gateway\AggregtionService;
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
    
    public function approve(int $withdrawal_id, string $ref_code)
    {
        $this->withdrawal_repository->beginTransaction();
        $result             = false;
        $aggregationService = new AggregtionService();
        try {
            $withdrawalItem
                     = $this->withdrawal_repository->find($withdrawal_id);
            $gateway = $withdrawalItem->gateway;
            // $user = $withdrawalItem->account->owner;
            $gateway->decrement('gateway_balance',
                $withdrawalItem->withdrawal_amount);
            $updateResult = $withdrawalItem->update(
                [
                    'withdrawal_ref_number' => $ref_code,
                    'withdrawal_status'     => WithDrawal::DONE,
                ]
            );
            
            if ($updateResult) {
                $aggregationService->withdrawal($withdrawalItem->withdrawal_gateway_id,
                    $withdrawalItem->withdrawal_amount);
            }
            
            //update Report
            $this->withdrawal_repository->commit();
            $result = true;
        } catch (\Exception $exception) {
            $this->withdrawal_repository->rollBack();
        }
        
        return $result;
    }
    
    public function reject(int $withdrawal_id)
    {
        $withdrawalItem = $this->withdrawal_repository->find($withdrawal_id);
        
        return $withdrawalItem->update([
            'withdrawal_status' => WithDrawal::REJECTED,
        ]);
    }
}