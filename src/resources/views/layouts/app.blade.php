<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>
<style>
  #modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white; /* 半透明の黒色背景 */
    z-index: 1000;
}

#modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff; /* モーダルの背景色 */
    padding: 20px;
    z-index: 1001; /* #modal-overlay より上に表示 */
    display: none; /* 最初は非表示 */
}

</style>
<body>
<header>
    <!-- メニューボタン（.menu-btn） -->
    <button id="menu-toggle" style="border: none; outline: none;">
        <div class="menu-btn">
            <span></span>
        </div>
    </button>

    <!-- ハンバーガーメニューの内容 -->
    <div id="modal-overlay" style="display: none;">
        <div id="modal" style="display: none;">
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
    </div>
</header>

<!-- ページ遷移用のJavaScript -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#menu-toggle").click(function() {
            // モーダルを表示
            $("#modal-overlay").show();
            $("#modal").show();
        });

        $("#modal-overlay").click(function(event) {
            // モーダルの外側をクリックした場合は閉じる
            if (event.target.id === "modal-overlay") {
                closeModal();
            }
        });

        function closeModal() {
            // モーダルを非表示
            $("#modal-overlay").hide();
            $("#modal").hide();
        }

        // メニュー項目がクリックされたときにもモーダルを非表示にする
        $("#modal ul.navbar-nav li.nav-item a.nav-link").click(function() {
            closeModal();
        });
    });
</script>
<!-- コンテンツ部分 -->
<div id="main-content">
    @yield('content')
</div>
</body>
</html>
