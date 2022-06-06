@extends('template.logged_in')

@section('title',$title)

@section('content')
<h1>プロフィールの編集</h1>
<form method="post" action="{{route('profile.update',$profile)}}">
    @csrf
    @method('patch')
    <label>名前:<br><input type="text" name="name" value="{{$profile->name}}"></label><br>
    <label>プロフィール:<br><textarea name="profile" cols="50" rows="10">{{$profile->profile}}</textarea><br>
    <input type="submit" name="更新">
</form>
@endsection