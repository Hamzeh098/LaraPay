<?php


namespace App\Presenters\Plan;


use App\Helpers\Format\Number;
use App\Presenters\Contacts\Presenter;

class PlanPresenter extends  Presenter
{
    public function gateway_plan_commission()
    {
        return Number::persianNumbers($this->entity->gateway_plan_commission). ' % ';
    }
    public function gateway_plan_withdrawal_max()
    {
        return Number::persianNumbers(number_format($this->entity->gateway_plan_withdrawal_max)) . ' تومان  ';
    }
    
    public function gateway_plan_withdrawal_rate()
    {
        return Number::persianNumbers($this->entity->gateway_plan_withdrawal_rate);
    }
}