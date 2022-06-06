@extends('template.default')
@section('header')
<ul class="header_nav">
    <li>
        <a href="{{route('register')}}">ユーザー登録</a>
    </li>
    <li>
        <a href="{{route('login')}}">ログイン</a>
    </li>
</ul>
@endsection