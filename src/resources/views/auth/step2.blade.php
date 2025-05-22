<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録2</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    
    <form method="POST" action="{{ url('/register/step2') }}">
    <h1>PiGLy</h1>
    <h2>新規会員登録</h2>
    <h3>STEP2 体重データの登録</h3>
        @csrf
        <div>
            <label for="latest_weight">現在の体重</label>
            <input type="number" name="latest_weight" step="0.1" value="{{ old('latest_weight') }}">kg
              @error('latest_weight')
                <div class="error-message">{{ $message }}</div>
              @enderror
        </div>


        <div>
            <label for="target_weight">目標の体重</label>
            <input type="number" name="target_weight" step="0.1" value="{{ old('target_weight') }}">kg
               @error('target_weight')
                <div class="error-message">{{ $message }}</div>
               @enderror
        </div>

        <div class="button-area">
          <button type="submit">登録して始める</button>
        </div>
    </form>
    </body>
    </html>
