<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    
    protected $primaryKey = 'gateway_plan_id';
    protected $guarded = ['gateway_plan_id'];
    protected $table = 'gateway_plans';
    
    
    public function gateways()
    {
        return $this->hasMany(Gateway::class, 'gateway_plan')->withDefault([
            'gateway_plan' => 'طرح نقره ای',
        ]);
    }
}
