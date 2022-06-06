@extends('template.not_logged_in')

@section('content')
<h1>サインアップ</h1>

<form method="post" action="{{route('register')}}">
    @csrf
    <div>
        <label>ユーザー名:<br><input type="text" name="name"></label>
    </div>
    <div>
        <label>メールアドレス:<br><input type="email" name="email"></label>
    </div>
    <div>
        <label>パスワード:<br><input type="password" name="password" autocomplete="new_password"></label>
    </div>
    <div>
        <label>パスワード(確認用):<br><input type="password" name="password_confirmation" autocomplete="new_password"></label>
    </div>
    <input type="submit" value="登録">
</form>

@endsection