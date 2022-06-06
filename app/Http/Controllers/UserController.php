<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Category;
use App\Order;

class UserController extends Controller
{
    //ログイン認証処理(アクセス制限)
    public function __construct()
    {
        $this->middleware('auth');
    }
    //出品商品一覧
    public function index()
    {
        $user=\Auth::user();
        $items=Item::where('user_id',\Auth::user()->id)->latest()->get();
        //$categorys=Category::find($items->pluck('category_id'));
        //$category=$items->categoryId;
        //dd($category);
        //$categorys=Category::where('id',$items->pluck('category_id'))->first();
        return view('users.exhibitions',[
            'title'=>'出品商品一覧画面',
            'items'=>$items,
            ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $user=User::find($id);
        // $orders=Order::where('user_id',$profile->pluck('id'))->get();
        // $item=Item::where('id',$orders->pluck('item_id'))->first();
        // $post_num=Item::where('user_id',$profile->pluck('id'))->count();
        
        return view('users.show',[
            'title'=>'プロフィール画面',
            'user'=>$user,
            ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
