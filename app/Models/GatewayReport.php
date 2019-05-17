<?php

namespace App\Models;

use App\Presenters\Contacts\Presentable;
use App\Presenters\Gateway\GatewayReportPresenter;
use Illuminate\Database\Eloquent\Model;

class GatewayReport extends Model
{
    use Presentable;
    protected $presenter = GatewayReportPresenter::class;
    
    
    protected $primaryKey = 'gateway_report_id';
    
    protected $guarded = ['gateway_report_id'];
    
    /*Relation*/
    public function gateway()
    {
        return $this->belongsTo(Gateway::class,'gateway_report_gateway_id');
    }
    /*End Relation*/
}
