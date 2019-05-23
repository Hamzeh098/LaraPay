<?php

namespace App\Models;

use App\Presenters\Contacts\Presentable;
use App\Presenters\Withdrawal\WithdrawalPresenter;
use Illuminate\Database\Eloquent\Model;

class WithDrawal extends Model
{
    use Presentable;
    protected $presenter = WithdrawalPresenter::class;
    
    const PENDING = 1;
    const DONE = 2;
    const REJECTED = 3;
    
    protected $primaryKey = 'withdrawal_id';
    protected $guarded = ['withdrawal_id'];
    
    /*functions */
    public function done()
    {
        $this->withdrawal_status = self::DONE;
        $this->save();
    }
    
    public static function getStatuses()
    {
        return [
            self::PENDING  => 'در حال بررسی',
            self::DONE     => 'انجام شده',
            self::REJECTED => 'رد شده',
        ];
    }
    /*ENd Functions*/
    
    /*Relations*/
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'withdrawal_gateway_id');
    }
    
    public function account()
    {
        return $this->belongsTo(UserAccount::class,
            'withdrawal_user_account_id');
    }
    /*End Relations*/
    
}
