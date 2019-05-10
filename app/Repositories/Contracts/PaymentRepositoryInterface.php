<?php


namespace App\Repositories\Contracts;


interface PaymentRepositoryInterface extends RepositoryInterface
{
    public function getReportData($startDate,$endDate);
}