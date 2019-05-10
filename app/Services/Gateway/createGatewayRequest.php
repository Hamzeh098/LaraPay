<?php


namespace App\Services\Gateway;


class createGatewayRequest
{
    private $userID;
    private $planID;
    private $title;
    private $status;
    private $bank;
    
    public function __construct(array $data)
    {
        $this->userID = $data['owner'];
        $this->planID = $data['plan'];
        $this->title = $data['title'];
        $this->status = $data['status'];
        $this->bank = 1;
        
    }
    
    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }
    
    /**
     * @return mixed
     */
    public function getPlanID()
    {
        return $this->planID;
    }
    
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    
  
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @return int
     */
    public function getBank(): int
    {
        return $this->bank;
    }
}