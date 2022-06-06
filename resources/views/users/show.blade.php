@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1 class="content_title">プロフィール</h1>
<div class="content_area">
    <div class="profile_top">
        @if($user->image!=='')
        <img src="{{asset('storage/'.$user->image)}}" class="profile_image">
        @else
        <img src="{{asset('image/no_image.png')}}" class="profile_image">
        @endif
        <a href="{{route('profile.edit_image')}}"  class="profile_text">画像を変更</a>
    </div>
    <p class="top_explain">{{Auth::user()->name}}さん</p>
    <p class="top_explain">{{$user->profile}}</p>
    <a href="{{route('profile.edit')}}">プロフィール編集</a>
    <p class="top_category">出品数:{{$user->items()->count()}}</p>
</div>
<h1>購入履歴</h1>
<ul>
    @forelse ($user->orderItems as $item)
        <li>
            {{$item->name}}: {{$item->price}}円 出品者: {{$item->user->name}}
        </li>
    @empty
        <li>購入商品はありません</li>
    @endforelse
</ul>
</div>
@endsection