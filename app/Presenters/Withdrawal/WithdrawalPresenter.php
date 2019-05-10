<?php


namespace App\Presenters\Withdrawal;


use App\Helpers\Format\Number;
use App\Presenters\Contacts\Presenter;

class WithdrawalPresenter extends Presenter
{
    
    public function amount()
    {
        return Number::persianNumbers(number_format($this->entity->withdrawal_amount));
    }
    
    public function commission()
    {
        return Number::persianNumbers(number_format($this->entity->withdrawal_commission));
    }
    
    public function create()
    {
        return $this->entity->created_at;
    }
    
    public function update()
    {
        return $this->entity->updated_at;
    }
    
    
}