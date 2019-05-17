<?php


namespace App\Presenters\Withdrawal;


use App\Helpers\Currency\PersianCurrency;
use App\Helpers\Format\Number;
use App\Models\WithDrawal;
use App\Presenters\Contacts\Presenter;

class WithdrawalPresenter extends Presenter
{
    
    public function amount()
    {
        return PersianCurrency::toman($this->entity->withdrawal_amount);
    }
    
    public function commission()
    {
        return Number::persianNumbers(number_format($this->entity->withdrawal_commission))
               .' % ';
    }
    
    public function create()
    {
        return Number::persianNumbers(verta($this->entity->created_at));
    }
    
    public function update()
    {
        return Number::persianNumbers(verta($this->entity->updated_at));
    }
    
    public function adminStatus()
    {
        $status = $this->entity->withdrawal_status;
        $result = '';
        switch ($status) {
            case WithDrawal::PENDING:
                $result
                    = '<span class="badge badge-warning">درحال بررسی</span>';
                break;
            case WithDrawal::DONE:
                $result = '<span class="badge badge-success">تایید شده</span>';
                break;
            case WithDrawal::REJECTED:
                $result = '<span class="badge badge-danger">برگشت شده</span>';
                break;
            default:
                $result = '<span class="badge badge-dark">نامشخص</span>';
                break;
        }
        return $result;
    }
    
    public function adminOperations()
    {
        $status = $this->entity->withdrawal_status;
        $withdrawal = $this->entity;
        if ($status == WithDrawal::PENDING)
        {
            return view('admin.withdrawal.operation',compact('withdrawal'))->render();
        }
        
    }
    
    
}