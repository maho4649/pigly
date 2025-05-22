<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

<form method="POST" action="{{ route('login') }}">
 <h1>PiGLy</h1>
 <h2>ログイン</h2>
    @csrf
    <label for="email">メールアドレス</label><br>
    <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus><br>
    @error('email')
    <div class="error-message">{{ $message }}</div>
    @enderror

    <label for="password">パスワード</label><br>
    <input type="password" name="password" id="password" ><br>
    @error('password')
    <div class="error-message">{{ $message }}</div>
    @enderror

    <label>
        <input type="checkbox" name="remember"> 次回から自動ログイン
    </label><br><br>

  <div class="button-area">
    <button type="submit">ログイン</button>
    <a href="{{ route('register.step1') }}" >アカウント作成はこちら</a>
  </div>
</form>
</body>
</html>

