<?php

namespace App\Services\GatewayTransaction;


class GatewayTransactionRequest
{
    private $token;
    private $amount;
    private $res_number;
    private $ip;
    private $domain;

    public function __construct(array $params)
    {
        $this->token = $params['token'];
        $this->amount = $params['amount'];
        $this->res_number = $params['resNumber'];
        $this->ip = $params['ip'];
        $this->domain = $params['domain'];
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
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
    public function getResNumber()
    {
        return $this->res_number;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

}