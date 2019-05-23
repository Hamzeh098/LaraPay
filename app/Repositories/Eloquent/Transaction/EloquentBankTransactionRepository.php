<?php


namespace App\Repositories\Eloquent\Transaction;


use App\Models\BankTransaction;
use App\Repositories\Contracts\BankTransactionRepositoryInterface;
use App\Repositories\Contracts\EloquentBaseRepository;

class EloquentBankTransactionRepository extends EloquentBaseRepository implements BankTransactionRepositoryInterface
{
    protected $model = BankTransaction::class;
}