<?php

namespace App\Models;

use App\Presenters\Contacts\Presentable;
use App\Presenters\Plan\PlanPresenter;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use Presentable;
    protected $presenter = PlanPresenter::class;
    
    protected $primaryKey = 'gateway_plan_id';
    protected $guarded = ['gateway_plan_id'];
    protected $table = 'gateway_plans';
    
    
    /*Relations*/
    public function gateways()
    {
        return $this->hasMany(Gateway::class, 'gateway_plan')->withDefault([
            'gateway_plan' => 'طرح نقره ای',
        ]);
    }
    /*End Relations*/
}
