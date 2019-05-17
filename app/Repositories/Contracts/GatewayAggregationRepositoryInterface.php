<?php


namespace App\Repositories\Contracts;


interface GatewayAggregationRepositoryInterface extends RepositoryInterface
{
    public function existAggregation($gateway , $date);
}