<?php

namespace App\Services\GatewayTransaction;


class GatewayTransactionRequest
{
    private $token;
    private $amount;
    private $res_number;
    private $ip;
    private $domain;
    private $description;
    private $callBackUrl;

    public function __construct(array $params)
    {
        $this->token = $params['token'];
        $this->amount = $params['amount'];
        $this->res_number = $params['res_number'];
        $this->ip = $params['ip'];
        $this->domain = $params['domain'];
        $this->description = $params['description'];
        $this->callBackUrl = $params['callbackUrl'];
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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCallBackUrl()
    {
        return $this->callBackUrl;
    }


}