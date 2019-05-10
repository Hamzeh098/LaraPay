<?php


namespace App\Services\Reporter;



use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Services\Reporter\Output\OutputReporter;

class PaymentReporter
{
    private $reposotory;

    public function __construct()
    {
       $this->reposotory = resolve(PaymentRepositoryInterface::class);
    }

    public function between($startDate,$endDate,OutputReporter $output)
    {
       $result =  $this->getData($startDate,$endDate);
       return $output->Output($result);
    }

    public function getData($startData,$endData)
    {
        return $this->reposotory->getReportData($startData,$endData);
    }


}