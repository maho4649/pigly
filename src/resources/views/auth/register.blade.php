<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

<form method="POST" action="{{ route('register') }}">
 <h2>会員登録</h2>
    @csrf

    <div>
        <label>名前</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>パスワード</label>
        <input type="password" name="password" required>
        @error('password') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>パスワード（確認）</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <div class="button-area">
    <button type="submit">次に進む</button>
    <a href="{{ route('login') }}" >ログインはこちら</a>
</div>
</form>
</body>
</html>
