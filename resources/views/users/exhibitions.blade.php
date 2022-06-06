@extends('template.logged_in')

@section('title',$title)

@section('content')
<!--シーダーにてCategoryTabSeederをdb:seedしておくこと-->
<div class="content_section">
<h1 class="content_title">テストの出品商品一覧</h1>
<a href="{{route('items.create')}}" class="content_link">新規出品</a>
<ul>
    @forelse($items as $item)
    <li class="content_area">
        @if($item->orders()->count()>0)
            <p>状態:売り切れ</p>
        @else
            <p>状態:販売中</p>
        @endif
        <div class="content_top">
            @if($item->image!=='')
            <a href="{{route('items.show',$item)}}"><img src="{{asset('storage/'.$item->image)}}" class="content_image"></a>
            @else
            <img src="{{asset('images/no_image.png')}}" class="content_image">
            @endif
            <p class="content_text">{{$item->description}}</p>
        </div>
        <p class="top_name">商品名:{{$item->name}}</p>
        <p class="top_price">価格:{{$item->price}}円</p>
        <p class="top_category">カテゴリー:
        {{$item->category->name}}
        ({{$item->created_at}})
        </p>
        <span>[<a href="{{route('items.edit',$item)}}">編集</a>]</span>
        <span>[<a href="{{route('items.edit_image',$item)}}">画像を変更</a>]</span>
        <form method="post" action="{{route('items.destroy',$item)}}">
            @csrf
            @method('delete')
            <input type="submit" value="削除">
        </form>
    </li>
    @empty
    <li>投稿はありません。</li>
    @endforelse
</ul>
</div>
@endsection