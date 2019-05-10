<?php

namespace App\Models;

use App\Presenters\Contacts\Presentable;
use App\Presenters\User\UserAccountPresenter;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use Presentable;
    protected $presenter = UserAccountPresenter::class;
    
    const ACTIVE = 1;
    const INACTIVE = 2;
    
    protected $primaryKey = 'user_account_id';
    protected $guarded = ['user_account_id'];
    
    public static function getStatuses()
    {
        return [
            self::ACTIVE   => 'فعال',
            self::INACTIVE => 'غیر فعال',
        ];
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_account_user_id');
    }
    
    public function withdrawal()
    {
        return $this->hasMany(WithDrawal::class, 'withdrawal_user_account_id');
    }
}
