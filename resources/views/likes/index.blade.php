@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1>{{$title}}</h1>
<ul>
    @forelse($like_items as $like_item)
    <li class="like_area">
        @if($like_item->orders()->count()>0)
            <p>状態:売り切れ</p>
        @else
            <p>状態:販売中</p>
        @endif
        <div class="content_top">
            @if($like_item->image!=='')
            <a href="{{route('items.show',$like_item)}}"><img src="{{asset('storage/'.$like_item->image)}}" class="content_image"></a>
            @else
            <img src="{{asset('images/no_image.png')}}" class="content_image">
            @endif
            <p class="content_text">{{$like_item->description}}</p>
        </div>
        <p>商品名:{{$like_item->name}}</p>
        <p>価格:{{$like_item->price}}円</p>
        <p>
            {{$like_item->category->name}}
            ({{$like_item->created_at}})
        </p>
    </li>
    @empty
    <li>商品はありません。</li>
    @endforelse
</ul>
</div>
@endsection