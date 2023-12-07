@extends('layouts.app')

@section('content')
    <!-- ハンバーガーメニューのHTMLとJavaScriptのコードを追加 -->
    <header>
        <nav>
            <!-- メニューボタン（.menu-btn） -->
            <button id="menu-toggle" style="border: none; outline: none;">
                <div class="menu-btn">
                    <span></span>
                </div>
            </button>

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
            </nav>
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
    <div class="registration-form">
        <h1>Registration</h1>
        <form>
            <div class="iconUser"></div>
            <input type="text" placeholder="Username" required>
            <div class="iconEmail"></div>
            <input type="email" placeholder="Email" required>
            <div class="iconPassword"></div>
            <input type="password" placeholder="Password" required>
            <input type="submit" value="登録">
        </form>
    </div>
@endsection