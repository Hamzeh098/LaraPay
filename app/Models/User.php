<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contacts\Presentable;
use App\Presenters\User\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Presentable,Filterable;
    protected $presenter = UserPresenter::class;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
        ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];
    
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }
    
    public function accounts()
    {
        return $this->hasMany(UserAccount::class,'user_account_user_id');
    }
    
    public function gateways()
    {
        return $this->hasMany(Gateway::class,'gateway_user_id');
    }
    
}
