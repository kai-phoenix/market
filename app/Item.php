<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=['user_id','name','description','category_id','price','image'];
    
    //他の人の出品商品を返すスコープ
    public function otherItem($query,$self_id)
    {
        return $query->where('user_id','!=',$self_id)->latest();
    }
    
    //リレーション(like)
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function likeUsers()
    {
        return $this->belongsToMany('App\User','likes');
    }
    
    //投稿がユーザーにいいねされているかをチェック
    public function isLikedBy($user)
    {
        //商品ID２をlikeしているユーザーが5,7,9の３人だとすると
        //$liked_user_idsは[5,7,9]
        $liked_users_ids=$this->likeUsers->pluck('id');
        //[5,7,9]に
        $result=$liked_users_ids->contains($user->id);
        return $result;
    }
    
    //Orderテーブルへのリレーション
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    //Categoryテーブルへのリレーション
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    //Userテーブルへのリレーション
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
