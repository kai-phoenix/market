@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1>商品情報の編集</h1>
<h2>商品追加フォーム</h2>
<form method="post" action="{{route('items.update',$item)}}">
    @csrf
    @method('patch')
    <label>商品名:<br><input type="text" name="name" value="{{$item->name}}"></label><br>
    <label>商品説明:<br><textarea name="description" cols="50" rows="10">{{$item->description}}</textarea><br>
    <label>価格:<br><input type="text" name="price" value="{{$item->price}}"></label><br>
    <label>カテゴリー:<br>
    <select name="category">
        @forelse($categorys as $category)
        @if($item->category_id===$category->id)
        <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @else
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @empty
        @endforelse
    </select>
    </label><br>
    <input type="submit" name="出品">
</form>
</div>
@endsection