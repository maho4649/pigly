<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>体重管理アプリ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="bg-gray-50 text-gray-800 sticky top-0 z-10">
    <header class="bg-white shadow sticky top-0 z-10 px-4 py-3 mb-4">
      <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0 fs-3 " style="color: #e83e8c;">PiGLy</h1>
        <nav class="d-flex gap-2 align-items-center">
        <a href="{{ route('goal.edit') }}" class="btn btn-outline-primary">目標体重設定</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">ログアウト</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">ログイン</a>
                <a href="{{ route('register.step1') }}" class="btn btn-outline-secondary">会員登録</a>
            @endauth
        </nav>
    </header>
    

    <main class="container mx-auto">
        @yield('content')
    </main>

    
</body>
</html>
