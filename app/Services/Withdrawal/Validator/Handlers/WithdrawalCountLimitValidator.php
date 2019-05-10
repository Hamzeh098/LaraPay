<?php


namespace App\Services\Withdrawal\Validator\Handlers;


use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Services\Withdrawal\Validator\Contracts\Validator;
use App\Services\Withdrawal\Validator\Exceptions\WithdrawalCountLimitException;
use App\Services\Withdrawal\WithdrawalRequest;

class WithdrawalCountLimitValidator extends Validator
{
    
    public function process(WithdrawalRequest $request)
    {
        $withdrawalRepository = resolve(WithdrawalRepositoryInterface::class);
        $withdrawalCount = $withdrawalRepository->getUserAccountWithdrawalCount($request->getAccount());
        $withdrawallimit = $request->getRate();
        if ($withdrawalCount >= $withdrawallimit) {
            throw new WithdrawalCountLimitException('تعداد درخواست های واریز شما در ماه از حد مجاز پلن شما فراتر رفته است');
        }
        
        return true;
    }
}