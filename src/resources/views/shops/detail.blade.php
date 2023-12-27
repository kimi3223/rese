<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .bracket {
            display: inline-block;
            background-color: white;
            border: 1px solid black;
            padding: 2px 5px; /* 適宜調整 */
            border-radius: 5px; /* 角の丸みを調整 */
        }

        .bracket-content {
            color: black;
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
                    <a id="back-to-home" onclick="closeModal()">×</a>
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
    <div style="display: flex;">
        <div class="flex-container" >
            <!-- 上部：＜と店舗名と＞横一列 -->
            <div style="display: flex; align-items: center;">
                @if ($previousShopId)
                    <a href="{{ route('shop.detail', ['shop_id' => $previousShopId]) }}">＜</a>
                @else
                    <span>＜</span>
                @endif
                <h2 id="shopName">{{ $shop->name }}</h2>
                <!-- 右側ボタン -->
                @if ($nextShopId)
                    <a href="{{ route('shop.detail', ['shop_id' => $nextShopId]) }}">＞</a>
                @else
                    <span>＞</span>
                @endif
            </div>

            <!-- 下部：image_urlとdescription横一列 -->
            <div style="display: flex; flex-direction: column;">
                <img id="shopImage" src="{{ $shop->image_url }}" alt="{{ $shop->name }}" style="max-width: 100%;">
                <p id="shopDescription">{{ $shop->description }}</p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; flex: 1;">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <!-- 右側：予約フォーム -->
        <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" id="shop_id" name="shop_id" value="{{ $shop->id }}">
            <h3>予約</h3> <!-- 予約のタイトルを追加 -->
            <!-- 日付選択 -->
            <label for="reservation_date"></label>
            <input type="date" id="reservation_date" name="reservation_date" required onchange="updateReservationDetails()">
            <br>

            <!-- 時間選択 -->
            <label for="reservation_time"></label>
            <input type="time" id="reservation_time" name="reservation_time" required onchange="updateReservationDetails()">
            <br>

            <!-- 人数選択 -->
            <label for="number_of_guests"></label>
            <input type="number" id="number_of_guests" name="number_of_guests" min="1" required onchange="updateReservationDetails()">
            <br>

            <!-- 予約確認 -->
            <div id="reservationDetailsContainer">
                <p></p>
                <div id="reservationDetails">
                    <!-- ここに予約内容の確認を表示 -->
                </div>
            </div>
            <!-- 予約ボタン -->
            <button type="submit" id="reserveButton">予約する</button>
        </form>
    </div>
    <!-- ページ遷移用のJavaScript -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateReservationDetails() {
        console.log('updateReservationDetailsが呼ばれました');
        // 他の処理を追加することもできます
    }

    $(document).ready(function () {
        // 以前のJavaScriptコードをそのまま残しています
        $("#menu-toggle").click(function () {
            // モーダルを表示
            $("#modal-overlay").toggle();
            $("#modal").toggle();

            // ハンバーガーアイコンと×アイコンを切り替える
            $(".menu-btn span").toggleClass("open");
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
            $(".menu-btn span").toggleClass("open");
        }

        // 予約ボタンのクリックイベント
        $("#reserveButton").click(function (e) {
            e.preventDefault(); // フォームの通常の送信を防止

            // フォームデータの取得
            var formData = {
                'shop_id': $('#shop_id').val(),
                'reservation_date': $('#reservation_date').val(),
                'reservation_time': $('#reservation_time').val(),
                'number_of_guests': $('#number_of_guests').val()
                // 他に必要なデータがあれば追加
            };

            // AJAXリクエスト
            $.ajax({
                type: 'POST',
                url: "{{ route('reservations.store') }}",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (data) {
                    // 成功時の処理（例: レスポンスからメッセージを表示）
                    console.log(data);
                    alert('予約が成功しました');
                },
                error: function (data) {
                    // エラー時の処理（例: レスポンスからエラーメッセージを表示）
                    console.log(data);
                    alert('予約が失敗しました');
                }
            });
        });

        // 日付、時間、人数が変更されたら予約詳細を更新
        $("#reservation_date, #reservation_time, #number_of_guests").on("change", function () {
            updateReservationDetails();
        });
    });
</script>
<script>
    // Bladeテンプレートから渡されたデータを保持する変数
    var previousShopId = {{ $previousShopId }};
    var nextShopId = {{ $nextShopId }};

    function showPreviousShop() {
        // 一つ前の店舗の詳細ページにリダイレクト
        window.location.href = '/shops/' + previousShopId;
    }

    function showNextShop() {
        // 一つ後の店舗の詳細ページにリダイレクト
        window.location.href = '/shops/' + nextShopId;
    }
</script>