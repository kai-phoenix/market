@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1>商品を出品</h1>
<h2>商品追加フォーム</h2>
<form method="post" action="{{route('items.store')}}" enctype="multipart/form-data">
    @csrf
    <label>商品名:<br><input type="text" name="name"></label><br>
    <label>商品説明:<br><textarea name="description" cols="50" rows="10"></textarea><br>
    <label>価格:<br><input type="text" name="price"></label><br>
    <label>カテゴリー:<br>
    <select name="category">
        @forelse($categorys as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @empty
        @endforelse
    </select>
    </label><br>
    <label>画像を選択:<input type="file" name="image" value="ファイルを選択"></label><br>
    <input type="submit" name="出品">
</form>
</div>
@endsection