<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;

class ProfileController extends Controller
{
    //ログイン認証処理(アクセス制限)
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile=User::find(\Auth::user()->id);
        return view('profile.edit',[
            'title'=>'商品情報の編集',
            'profile'=>$profile,
            ]);
    }
    public function editImage()
    {
        $profile=User::find(\Auth::user()->id);
        return view('profile.edit_image',[
            'title'=>'商品情報画像の編集',
            'profile'=>$profile,
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        $profile=User::find(\Auth::user()->id);
        $profile->update($request->only(['name','profile']));
        session()->flash('success','プロフィール情報を編集しました。');
        return redirect()->route('users.show',\Auth::user());
    }
    
    public function updateImage(ProfileImageRequest $request)
    {
        //画像投稿処理
        $path='';
        $image=$request->file('image');
        
        if(isset($image)===true)
        {
            //publicディスク(storage/app/public)のphotosディレクトリに保存
            $path=$image->store('photos','public');
        }
        $profile=User::find(\Auth::user()->id);
        //変更前の画像を削除
        if($profile->image !=='')
        {
            //publicディスクから該当の投稿画像($profile->image)を削除
            \Storage::disk('public')->delete(\Storage::url($profile->image));
        }
        
        $profile->update([
            'image'=>$path,
            ]);
            
        session()->flash('success','プロフィール画像を更新しました。');
        return redirect()->route('users.show',\Auth::user());
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
}
