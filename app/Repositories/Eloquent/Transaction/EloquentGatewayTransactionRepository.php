<?php


namespace App\Repositories\Eloquent\Transaction;


use App\Models\GatewayTransaction;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\GatewayTransactionRepositoryInterface;

class EloquentGatewayTransactionRepository extends EloquentBaseRepository implements GatewayTransactionRepositoryInterface
{
    protected $model = GatewayTransaction::class;
}