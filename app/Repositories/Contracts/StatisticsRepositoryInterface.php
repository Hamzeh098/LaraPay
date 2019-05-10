<?php


namespace App\Repositories\Contracts;


interface StatisticsRepositoryInterface
{
    public function totalGateway();

    public function todayTotalTransaction();

    public function todayWithdrawal();

    public function totalPendingGateway();

}