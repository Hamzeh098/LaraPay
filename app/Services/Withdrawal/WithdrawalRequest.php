<?php


namespace App\Services\Withdrawal;


class WithdrawalRequest
{
    
    private $gateway;
    private $account;
    private $amount;
    private $commission;
    private $rate;
    private $max_amount;
    private $status;
    
    public function __construct(array $data)
    {
        $this->gateway = $data['gateway'];
        $this->account= $data['account'];
        $this->amount= $data['amount'];
        $this->commission=$data['commission'];
        $this->rate = $data['rate'];
        $this->max_amount = $data['max'];
        $this->status=$data['status'];
    }
    
    /**
     * @return mixed
     */
    public function getGateway()
    {
        return $this->gateway;
    }
    
    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }
    
    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * @return mixed
     */
    public function getCommission()
    {
        return $this->commission;
    }
    
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    public static function fromArray(array $data)
    {
        return new static($data);
    }
    
    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }
    
    /**
     * @return mixed
     */
    public function getMaxAmount()
    {
        return $this->max_amount;
    }
    
    
}