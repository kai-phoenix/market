<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class LikeController extends Controller
{
    //ログイン認証処理(アクセス制限)
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $like_items=\Auth::user()->likeItems;
        return view('likes.index',[
            'title'=>'お気に入り一覧',
            'like_items'=>$like_items,
            ]);
    }
}
