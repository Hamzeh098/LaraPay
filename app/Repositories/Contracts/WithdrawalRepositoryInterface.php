<?php


namespace App\Repositories\Contracts;


interface WithdrawalRepositoryInterface extends RepositoryInterface
{
    public function getUserAccountWithdrawalCount(int $userAccountID);
    
    public function getStatuses();
}