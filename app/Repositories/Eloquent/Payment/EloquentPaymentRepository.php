<?php


namespace App\Repositories\Eloquent\Payment;


use App\Models\Payment;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class EloquentPaymentRepository extends EloquentBaseRepository implements PaymentRepositoryInterface
{
    protected $model = Payment::class;

    public function getReportData($startDate, $endDate)
    {
        return DB::table('payments')->where('paid_at',[$startDate,$endDate]);
    }
}