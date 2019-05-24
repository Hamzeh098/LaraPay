<?php


namespace App\Presenters\Gateway;


use App\Helpers\Format\Number;
use App\Presenters\Contacts\Presenter;

class GatewayReportPresenter extends Presenter
{
    
    public function name()
    {
        return $this->entity->gateway->gateway_title. '/ '.$this->entity->gateway->owner->name ;
    }
    
    public function date()
    {
        return Number::persianNumbers(verta($this->entity->gateway_report_date)->format("Y-m-d"));
    }
    
    public function deposit()
    {
        return Number::persianNumbers(number_format($this->entity->gateway_report_desposit));
    }
    
    public function withdrawal()
    {
        return Number::persianNumbers(number_format($this->entity->gateway_report_withdrawal));
    }

}