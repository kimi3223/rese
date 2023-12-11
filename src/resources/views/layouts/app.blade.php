<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include FontAwesome -->
</head>

<style>
    #modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        z-index: 1000;
    }

    #modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        z-index: 1001;
        display: none;
    }

    #back-to-home {
        cursor: pointer;
        font-size: 1.5em;
        text-decoration: none;
        color: black;
    }

    #company-name {
        margin-left: 10px;
    }

</style>

<body>
    <header>
        <nav>
            <!-- メニューボタン（.menu-btn） -->
            <button id="menu-toggle" style="border: none; outline: none;">
                <div class="menu-btn">
                    <span></span>
                </div>
            </button>

            <div class="search-box">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    @csrf
                    <div class="search-dropdown-container">
                        <select class="search-dropdown" name="region" id="region" autocomplete="off">
                            <option value="All area">All area</option>
                            <option value="東京都">東京都</option>
                            <option value="大阪府">大阪府</option>
                            <option value="福岡県">福岡県</option>
                            <!-- 他のエリアのオプションを追加 -->
                        </select>
                    </div>

                    <div class="search-dropdown-container">
                        <select class="search-dropdown" name="genre" id="genre">
                            <option value="All genre">All genre</option>
                            <option value="寿司">寿司</option>
                            <option value="焼肉">焼肉</option>
                            <option value="居酒屋">居酒屋</option>
                            <option value="イタリアン">イタリアン</option>
                            <option value="ラーメン">ラーメン</option>
                            <!-- 他のカテゴリのオプションを追加 -->
                        </select>
                    </div>

                    <div class="search-input-container">
                        <input type="text" name="name" placeholder="Search...">
                    </div>

                    <div class="search-button-container">
                        <button type="submit">検索</button>
                    </div>
                </form>
            </div>


            <!-- ハンバーガーメニューの内容 -->
            <div id="modal-overlay" style="display: none;">
                <div id="modal" style="display: none;">
                    <a id="back-to-home" onclick="closeModal()">×</a>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
                        </li>
                        <!-- 以下はログイン状態に応じて表示されるボタン -->
                        @if (Auth::check())
                        <li class="nav-item active">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout <span class="sr-only"></span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
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
                </nav>
            </div>
        </div>
    </header>

    <!-- ページ遷移用のJavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#menu-toggle").click(function () {
                // モーダルを表示
                $("#modal-overlay").toggle();
                $("#modal").toggle();

                // ハンバーガーアイコンと×アイコンを切り替える
                $(".menu-btn i").toggleClass("fa-bars fa-times");
            });

            $("#close-modal").click(function () {
                // ×アイコンをクリックしたら閉じる
                closeModal();
            });

            $("#modal-overlay").click(function (event) {
                // モーダルの外側をクリックした場合は閉じる
                if (event.target.id === "modal-overlay") {
                    closeModal();
                }
            });

            function closeModal() {
                // モーダルを非表示
                $("#modal-overlay").hide();
                $("#modal").hide();

                // ハンバーガーアイコンと×アイコンを切り替える
                $(".menu-btn i").toggleClass("fa-bars fa-times");
            }

            // メニュー項目がクリックされたときにもモーダルを非表示にする
            $("#modal ul.navbar-nav li.nav-item a.nav-link").click(function () {
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