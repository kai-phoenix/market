@extends('template.logged_in')

@section('content')
<div class="content_section">
<h1 class="content_title">{{$title}}</h1>
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
        
        <p>商品名:{{$item->name}}</p>
        <div class="content_info">
            <p>価格:{{$item->price}}円</p>
            <a class="like_button">{{$item->isLikedBy(Auth::user())?'★':'☆'}}</a>
            <form method="post" class='like' action="{{route('items.toggle_like',$item)}}">
                @csrf
                @method('patch')
            </form>
        </div>
        <p>
                カテゴリ:{{$item->category->name}}
                ({{$item->created_at}})
        </p>
    </li>
    @empty
    <li>投稿はありません。</li>
    @endforelse
</ul>
</div>
<script>
$('.like_button').on('click',(event)=>{
    $(event.currentTarget).next().submit();
    })
</script>
@endsection