@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1>商品詳細</h1>
<form method="post" action="{{route('items.confirm',$item)}}">
    @csrf
    <dl>
        <dt>商品名</dt>
        <dd>{{$item->name}}</dd>
        <dt>画像</dt>
        <dd><img src="{{asset('storage/'.$item->image)}}"></dd>
        <dt>カテゴリ</dt>
        <dd>{{$item->category->name}}</dd>
        <dt>価格</dt>
        <dd>{{$item->price}}</dd>
        <dt>説明</dt>
        <dd>{{$item->description}}</dd>
    </dl>
    @if($item->orders()->count()>0)
    <p>売り切れです。</p>
    @else
    <input type="submit" value="購入する">
    @endif
</form>
</div>
@endsection