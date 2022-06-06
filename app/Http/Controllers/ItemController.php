<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Like;
use App\Category;
use App\Order;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemEditImageRequest;

class ItemController extends Controller
{
    //ログイン認証処理(アクセス制限)
    public function __construct()
    {
        $this->middleware('auth');
    }
    //自分以外のユーザーの投稿内容を表示(TOP)
    public function index()
    {
        //Itemインスタンスを宣言
        $item=new Item;
        $user=\Auth::user();
        //$user=Item::where('user_id',\Auth::user()->id)->latest()->get();
        //dd($user);
        $items = $item->otherItem($item,$user->id)->get();
        //$category=Category::find($other_users->pluck('category_id'));
        //dd($category);
        //$category=new Category;
        return view('items.index',[
            'title'=>'息をするように買おう',
            'items'=>$items,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys=Category::get();
        return view('items.create',[
            'title'=>'新規出品',
            'categorys'=>$categorys,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        //画像投稿用のパス
        $path='';
        $image=$request->file('image');
        if(isset($image)===true)
        {
            //public/photosディレクトリに保存
            $path=$image->store('photos','public');
        }
        Item::create([
            'user_id'=>\Auth::user()->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'category_id'=>$request->category,
            'price'=>$request->price,
            'image'=>$path,
            ]);
            session()->flash('success','投稿を追加しました。');
            return redirect()->route('users.exhibitions',\Auth::user());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=Item::find($id);
        //取ってくるインスタンスが複数でなければエラーを吐くのでfirst()を追加
        $category=Category::find($item->pluck('category_id'))->first();
        //dd($category);
        return view('items.show',[
            'title'=>'商品詳細画面',
            'item'=>$item,
            'category'=>$category,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=Item::find($id);
        $categorys=Category::get();
        return view('items.edit',[
            'title'=>'商品情報の編集',
            'item'=>$item,
            'categorys'=>$categorys,
            ]);
    }
    public function editImage($id)
    {
        $item=Item::find($id);
        return view('items.edit_image',[
            'title'=>'出品商品画像編集画面',
            'item'=>$item,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemEditRequest $request, $id)
    {
        $item=Item::find($id);
        $item->update($request->only(['name','description','price','category_id']));
        session()->flash('success','出品情報を編集しました。');
        return redirect()->route('users.exhibitions',\Auth::user());
    }
    public function updateImage(ItemEditImageRequest $request,$id)
    {
        $path='';
        $image=$request->file('image');
        if(isset($image)===true)
        {
            //publicディスク(storage/app/public)のphotosディレクトリに保存するパスを生成
            $path=$image->store('photos','public');
        }
        $item=Item::find($id);
        //変更前の画像を削除
        if($item->image!=='')
        {
            //publicディスクから該当の投稿画像を削除
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        $item->update([
            'image'=>$path,
            ]);
        session()->flash('success','商品画像の変更に成功しました。');
        return redirect()->route('users.exhibitions',$item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::find($id);
        //出品商品画像の削除
        if($item->image!=='')
        {
            \Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        session()->flash('success','出品商品を取り消しました。');
        return redirect()->route('users.exhibitions',\Auth::user());
    }
    
    //お気に入りボタンの実装
    public function toggleLike($id)
    {
        $user=\Auth::user();
        $item=Item::find($id);
        //dd($item);
        if($item->isLikedBy($user))
        {
            //いいねの取り消し
            $item->likes->where('user_id',$user->id)->first()->delete();
            \Session::flash('success','いいねを取り消しました');
        }
        else
        {
            //いいねの設定
            Like::create([
                'user_id'=>$user->id,
                'item_id'=>$item->id,
            ]);
            \Session::flash('success','いいねしました');
        }
        return redirect()->route('top');
    }
    
    //商品確認画面
    public function confirm(Request $request,$id)
    {
        $item=Item::find($id);
        return view('items.confirm',[
            'title'=>'購入確認画面',
            'item'=>$item,
            ]);
    }
    //購入完了画面
    public function finish(Request $request,$id)
    {
        $item=Item::find($id);
        Order::create([
            'user_id'=>\Auth::id(),
            'item_id'=>$item->id,
            ]);
        
        return view('items.finish',[
            'title'=>'購入完了画面',
            'item'=>$item,
            ]);
    }
}