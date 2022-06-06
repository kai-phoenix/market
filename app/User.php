<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Follow;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //リレーション(like)
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    //中間テーブル
    public function likeItems()
    {
        return $this->belongsToMany('App\Item','likes')->orderBy('likes.created_at',"DESC");
    }
    
    //Itemクラスへのリレーション
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    //中間テーブルOrderクラスへのリレーション
    public function orderItems()
    {
        return $this->belongsToMany('App\Item','orders');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}