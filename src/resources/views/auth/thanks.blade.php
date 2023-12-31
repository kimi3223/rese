<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="http://localhost/css/sanitize.css">
    <link rel="stylesheet" href="http://localhost/css/app.css">
    <link rel="stylesheet" href="http://localhost/css/login.css">
    <link rel="stylesheet" href="http://localhost/css/thanks.css">
    <link rel="stylesheet" href="http://localhost/css/detail.css">
    <link rel="stylesheet" href="http://localhost/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include FontAwesome -->
</head>

<style>
    h1 {
        margin: 0; /* マージンを無効にする */
        background: blue;
        padding: 5px;
        font-size: 120%;
        font-weight: 300;
        color: #fff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    #modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        z-index: 1000;
        display: none;
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
        box-sizing: border-box;
    }

    #back-to-home {
        cursor: pointer;
        font-size: 1.5em;
        text-decoration: none;
        color: black;
    }

    #company-name {
        margin-left: 10px;
        font-size: 1.5em;
        color: blue;
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

            <!-- ハンバーガーメニューの内容 -->
            <div id="modal-overlay" style="display: none;">
                <div id="modal" style="display: none;">
                    <a id="back-to-home" href="#" onclick="closeModal()">×</a>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
                        </li>
                        <!-- 以下はログイン状態に応じて表示されるボタン -->
                        <li class="nav-item active before-login">
                            <a class="nav-link" href="/register">Register <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active before-login">
                            <a class="nav-link" href="/login">Login <span class="sr-only"></span></a>
                        </li>
                        <!-- ここまで -->
                    </ul>
                </div>
            </div>
            <div id="company-name">Rese</div>
        </nav>
    </header>
    <!-- ページ遷移用のJavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function closeModal() {
            // モーダルを非表示
            $("#modal-overlay").hide();
            $("#modal").hide();

            // ハンバーガーアイコンと×アイコンを切り替える
            $(".menu-btn i").toggleClass("fa-bars fa-times");
        }

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

            // メニュー項目がクリックされたときにもモーダルを非表示にする
            $("#modal ul.navbar-nav li.nav-item a.nav-link").click(function () {
                closeModal();
            });

            // フォームがサブミットされたときの処理
            $("form").submit(function () {
                // フォームが送信される前に実行する処理
                // ここでは何も実行しない

                // サブミットを続行する場合は true を返す
                return true;
            });
        });
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" >
                        <p>会員登録ありがとうございます</p>
                        <a href="{{ route('login') }}">ログインする</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
