<?php

namespace App\Models;

use App\Presenters\Contacts\Presentable;
use App\Presenters\Gateway\GatewayPresenter;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use Presentable;
    protected $presenter = GatewayPresenter::class;
    
    const ACTIVE = 1;
    const INACTIVE = 2;
    
    protected $primaryKey = 'gateway_id';
    
    protected $guarded = ['gateway_id'];
    
    
    public static function getStatuses()
    {
        return [
            self::ACTIVE   => 'فعال',
            self::INACTIVE => 'غیر فعال',
        ];
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'gateway_user_id');
    }
    
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'gateway_plan')->withDefault([
            'gateway_plan_title' => 'طرح نقره ای',
        ]);
    }
    
    public function withdrawal()
    {
        return $this->hasMany(WithDrawal::class, 'withdrawal_gateway_id');
    }
    
    public function aggregations()
    {
        return $this->hasMany(GatewayReport::class,'gateway_report_gateway_id');
    }
    
    
}
