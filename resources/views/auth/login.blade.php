@extends('template.not_logged_in')

@section('content')
<h1>ログイン</h1>

<form method="post" action="{{route('login')}}">
    @csrf
    <div>
        <label>メールアドレス:<br><input type="text" name="email"></label>
    </div>
    <div>
        <label>パスワード:<br><input type="password" name="password"></label>
    </div>
    <input type="submit" value="ログイン">
</form>

@endsection