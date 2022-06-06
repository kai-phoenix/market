@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1>購入確認画面</h1>
<form method="post" action="{{route('items.finish',$item)}}">
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
    <input type="submit" value="内容を確認し購入する">
</form>
</div>
@endsection