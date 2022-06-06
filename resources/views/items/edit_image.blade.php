@extends('template.logged_in')

@section('title',$title)

@section('content')
<div class="content_section">
<h1>商品画像の変更</h1>
<h2>現在の画像</h2>
@if($item->image!=='')
<img src="{{\Storage::url($item->image)}}">
@else
画像はありません
@endif
<br>
<form method="post" action="{{route('items.update_image',$item)}}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <label>画像を選択:<input type="file" name=image></label><br>
    <input type="submit" value="更新">
</form>
</div>
@endsection