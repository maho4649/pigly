<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録1</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>


<form method="POST" action="{{ route('register.step1') }}">
<h1>PiGLy</h1>
<h2>新規会員登録</h2>
<h3>STEP1 アカウント情報の登録</h3>

    @csrf
    <label>お名前<input type="text" name="name" value="{{ old('name') }}"></label><br>
      @error('name')
      <div class="error-message">{{ $message }}</div>
      @enderror
    <label>メールアドレス <input type="email" name="email" value="{{ old('email') }}"></label><br>
      @error('email')
        <div class="error-message">{{ $message }}</div>
      @enderror
    <label>パスワード<input type="password" name="password"></label><br>
      @error('password')
        <div class="error-message">{{ $message }}</div>
      @enderror
    <label>パスワード確認 <input type="password" name="password_confirmation"></label><br>
      @error('password')
       <div class="error-message">{{ $message }}</div>
      @enderror

<div class="button-area">
    <button type="submit">次へ進む</button>
    <a href="{{ route('login') }}" >ログインはこちら</a>
</div>
</form>
</body>
</html>
