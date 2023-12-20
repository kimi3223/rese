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
    <!-- ページ遷移用のJavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // 以前のJavaScriptコードをそのまま残しています
        $(document).ready(function () {
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
            });
    </script>
    <div style="display: flex;">
        <div class="flex-container" >
            <!-- 上部：＜と店舗名と＞横一列 -->
            <div style="display: flex; align-items: center;">
                <!-- 左側ボタン -->
                <button onclick="showPreviousShop()">＜</button>
                <h2 id="shopName">{{ $shop->name }}</h2>
                <!-- 右側ボタン -->
                <button onclick="showNextShop()">＞</button>
            </div>

            <!-- 下部：image_urlとdescription横一列 -->
            <div style="display: flex; flex-direction: column;">
                <img id="shopImage" src="{{ $shop->image_url }}" alt="{{ $shop->name }}" style="max-width: 100%;">
                <p id="shopDescription">{{ $shop->description }}</p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; flex: 1;">
            <!-- 右側：予約フォーム -->
            <div id="reservationForm" >
                <h3>予約</h3> <!-- 予約のタイトルを追加 -->
                <!-- 日付選択 -->
                <form method="POST" action="{{ route('reservations.store', ['shopId' => $shop->id]) }}">
                    @csrf
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
                        <div id="reservationDetails" >
                        <!-- ここに予約内容の確認を表示 -->
                        </div>
                    </div>
                    <!-- 予約ボタン -->
                    <form method="POST" action="{{ route('reservations.store', ['shopId' => $shop->id]) }}">
                        @csrf
                        <!-- フォームのフィールドはここに記述 -->
                        <button type="submit" id="reserveButton" >予約する</button>
                    </form>
                </div>
            </form>
        </div>

    <script>
const shops = {!! json_encode($shops) !!}; // ビューから渡された店舗のリスト
let currentIndex = shops.findIndex(shop => shop.id === {{ $shop->id }});

function showPreviousShop() {
    if (currentIndex > 0) {
        currentIndex--;
        showShopDetails();
    }
}

function showNextShop() {
    if (currentIndex < shops.length - 1) {
        currentIndex++;
        showShopDetails();
    }
}

function showShopDetails() {
    const currentShop = shops[currentIndex];
    document.getElementById('shopName').innerText = currentShop.name;
    document.getElementById('shopImage').src = currentShop.image_url;
    document.getElementById('shopDescription').innerText = currentShop.description;
}

// 初回表示時に現在の店舗詳細を表示
showShopDetails();
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // DOMが完全に読み込まれたときにイベントリスナーを追加する
        document.getElementById('reservation_date').addEventListener('change', updateReservationDetails);
        document.getElementById('reservation_time').addEventListener('change', updateReservationDetails);
        document.getElementById('number_of_guests').addEventListener('change', updateReservationDetails);
    });

    function updateReservationDetails() {
        // 選択された日付、時間、人数を取得
        var selectedDate = document.getElementById('reservation_date').value;
        var selectedTime = document.getElementById('reservation_time').value;
        var numberOfPeople = document.getElementById('number_of_guests').value;

        // 店舗名を取得
        var shopName = document.getElementById('shopName').innerText;

        // 予約確認エリアを更新
        document.getElementById('reservationDetails').innerHTML = `
            <p>Shop       ${shopName}</p>
            <p>Date       ${selectedDate}</p>
            <p>Time       ${selectedTime}</p>
            <p>Number     ${numberOfPeople}人</p>
        `;
    }
</script>