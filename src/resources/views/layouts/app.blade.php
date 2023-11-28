<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
  <!-- メニューボタン（.menu-btn） -->
  <button id="menu-toggle" style="border: none; outline: none;">
    <div class="menu-btn">
      <span></span>
    </div>
  </button>

  <!-- ハンバーガーメニューの内容 -->
    <div id="menu-content" style="display: none;">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
            </li>
            <!-- 以下はログイン状態に応じて表示されるボタン -->
            @if (Auth::check())
            <li class="nav-item active">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">Logout <span class="sr-only"></span></button>
              </form>
            </li>
            <li class="nav-item active after-login">
                <a class="nav-link" href="/mypage">Mypage <span class="sr-only"></span></a>
            </li>
            @else
            <li class="nav-item active before-login">
                <a class="nav-link" href="/register">Register <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active before-login">
                <a class="nav-link" href="/login">Login <span class="sr-only"></span></a>
            </li>
            @endif
            <!-- ここまで -->
        </ul>
    </div>
</header>

<!-- ページ遷移用のJavaScript -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
        // ハンバーガーメニューのトグル
        $("#menu-toggle").click(function() {
            // メニューコンテンツを表示または非表示に切り替える
            $("#menu-content").toggle();
            
            // メインコンテンツの表示切り替え
            $("#main-content").toggleClass("hide");
        });
    });

     function showContent(content) {
        // ここでcontentに応じて表示すべきコンテンツを切り替えるロジックを記述
        // 例えば、contentが'home'ならHomeのコンテンツを表示、'register'ならRegisterのコンテンツを表示、といった具体的な処理を記述する
        alert('Button clicked: ' + content);
        
        // メニューを非表示にする（任意）
        $("#menu-content").hide();
        
        // メインコンテンツを表示する
        $("#main-content").removeClass("hide");
    }
</script>

<!-- コンテンツ部分 -->
<div id="main-content">
    @yield('content')
</div>
</body>
</html>