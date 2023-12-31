<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="fc3Ry1CEmofdyhmKH47kUVVCRj5sL5BF8scYOHu0">
    <title>Rese</title>
    <link rel="stylesheet" href="http://localhost/css/sanitize.css">
    <link rel="stylesheet" href="http://localhost/css/app.css">
    <link rel="stylesheet" href="http://localhost/css/login.css">
    <link rel="stylesheet" href="http://localhost/css/thanks.css">
    <link rel="stylesheet" href="http://localhost/css/detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include FontAwesome -->
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
</head>

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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function closeModal() {
            $("#modal-overlay").hide();
            $("#modal").hide();
            $(".menu-btn span").toggleClass("open");
        }

        $(document).ready(function () {
            $("#menu-toggle").click(function () {
                $("#modal-overlay").toggle();
                $("#modal").toggle();
                $(".menu-btn span").toggleClass("open");
            });

            $("#close-modal").click(function () {
                closeModal();
            });

            $("#modal-overlay").click(function (event) {
                if (event.target.id === "modal-overlay") {
                    closeModal();
                }
            });

            // ページが読み込まれた時にログイン状態を確認して表示を変更
            checkLoginStatus();

            function checkLoginStatus() {
                const isLoggedIn = localStorage.getItem("isLoggedIn") === "true";
                updateMenuVisibility(isLoggedIn);
            }

            function updateMenuVisibility(isLoggedIn) {
                if (isLoggedIn) {
                    $(".before-login").hide();
                    // ログイン済みの場合、ここで他のメニューを表示する処理を追加
                } else {
                    $(".before-login").show();
                }
            }

            // ログインボタンを押したときの処理
            $("#login-button").click(function () {
                // 本来はサーバーでのログイン処理が成功したかどうかを確認してから以下を実行するべきです
                localStorage.setItem("isLoggedIn", "true");
                checkLoginStatus();
            });

            // ログアウトボタンを押したときの処理
            $("#logout-button").click(function () {
                localStorage.setItem("isLoggedIn", "false");
                checkLoginStatus();
            });
        });
    </script>

    <!-- コンテンツ部分 -->
    <div class="registration-form">
        <h1>Login</h1>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form-group">
                <div class="iconEmail"></div>
                <input type="email" id="email" name="email" placeholder="Email" required autocomplete="email">
            </div>
            <div class="form-group">
                <div class="iconPassword"></div>
                <input type="password" id="password" name="password" placeholder="Password" required
                    autocomplete="new-password">
            </div>
            <input type="submit" id="login-button" value="ログイン">
        </form>
    </div>

</body>

</html>