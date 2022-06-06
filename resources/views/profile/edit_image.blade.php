@extends('template.logged_in')

@section('title',$title)

@section('content')
<h1>プロフィール画像編集</h1>
<h2>現在の画像</h2>
<form method="post" action="{{route('profile.update_image',$profile)}}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    @if($profile->image!=='')
    <img src="{{\Storage::url($profile->image)}}">
    @else
    画像はありません。
    @endif
    <br>
    <label>画像を選択:<input type="file" name=image></label><br>
    <input type="submit" value="更新">
</form>
@endsection