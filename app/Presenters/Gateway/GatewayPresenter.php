<?php


namespace App\Presenters\Gateway;


use App\Models\Gateway;
use App\Presenters\Contacts\Presenter;

class GatewayPresenter extends Presenter
{
    public function GatewayStatus()
    {
        switch ($this->entity->gateway_status) {
            case Gateway::ACTIVE:
                return '<span class="badge badge-success">فعال</span>';
                break;
            case Gateway::INACTIVE:
                return '<span class="badge badge-danger">غیر فعال</span>';
                break;
            default:
                return '<span class="badge badge-dark">نامشخص</span>';
                break;
        }
        
    }
}