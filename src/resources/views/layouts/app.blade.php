<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap JavaScript CDN (Popper.jsおよびBootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<header>
<!-- Bootstrapのナビゲーションバー -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <!-- メニューボタン（.menu-btn） -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; outline: none;">
    <div class="menu-btn">
      <span></span>
    </div>
  </button>

  <!-- ナビゲーションバーのコンテンツ -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      @if (Auth::check())
      <li class="nav-item active">
        <a class="nav-link" href="/logout">Logout <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/mypage">Mypage <span class="sr-only">(current)</span></a>
      </li>
      @else
      <li class="nav-item active">
        <a class="nav-link" href="/register">Register <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/login">Login <span class="sr-only">(current)</span></a>
      </li>
      @endif
      <!-- 他のメニューアイテムを追加 -->
    </ul>
  </div>
</nav>
</header>

    <!-- 検索フォーム -->
    <div id="searchForm" style="display: none;">
        <!-- ここに検索フォームのHTMLを追加 -->
        <!-- 例: <form action="{{ url('/search') }}" method="get">...</form> -->
        <!-- ここに検索ボタンや入力フィールドを配置してください -->
    </div>

    <!-- コンテンツ部分 -->
    @yield('content')

    <!-- JavaScriptの例 -->
    <script>
        function toggleSearch() {
            var searchForm = document.getElementById('searchForm');
            searchForm.style.display = (searchForm.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</body>
</html>