<?php
/**
 * Created by PhpStorm.
 * User: MOHAMMAD
 * Date: 29/05/2019
 * Time: 02:53 PM
 */

namespace App\Services\GatewayTransaction;


class TransactionVerifiyRequest
{
    private $token;
    private $amount;
    private $transactionKey;
    private $res_number;

    public function __construct(array $data)
    {
        $this->token = $data['token'];
        $this->amount = $data['amount'];
        $this->transactionKey = $data['transactionKey'];
        $this->res_number = $data['res_number'];
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
    public function getTransactionKey()
    {
        return $this->transactionKey;
    }

    /**
     * @return mixed
     */
    public function getResNumber()
    {
        return $this->res_number;
    }

}