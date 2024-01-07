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
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <button id="menu-toggle" style="border: none; outline: none;">
                <div class="menu-btn">
                    <span></span>
                </div>
            </button>
            <div id="modal-overlay" style="display: none;">
                <div id="modal" style="display: none;">
                    <a id="back-to-home" href="#" onclick="closeModal()">×</a>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
                        </li>
                        @guest
                            <li class="nav-item active before-login">
                                <a class="nav-link" href="/register">Register <span class="sr-only"></span></a>
                            </li>
                            <li class="nav-item active before-login">
                                <a class="nav-link" href="/login">Login <span class="sr-only"></span></a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <div id="company-name">Rese</div>
        </nav>
    </header>

    <div style="display: flex;">
        <div style="width: 50%; padding-right: 20px;">
            <!-- 予約一覧 -->
            <h3>予約状況</h3>
            @if($reservations)
                @foreach($reservations as $index => $reservation)
                <!-- 予約情報の表示 -->
                <div style="display: flex; flex-direction: column; border: 1px solid #ccc; padding: 10px; background: rgb(0, 89, 255); color: white; margin: 10%; border-radius: 10%;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <i class="fas fa-clock" style="margin-right: 10px;"></i>
                            <h2>予約{{ $index + 1 }}</h2>
                        </div>
                        <div>
                            <!-- ×ボタン -->
                            <form method="POST" action="{{ route('reservations.destroy', ['reservationId' => $reservation->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">×</button>
                            </form>
                            <!-- 予約変更ボタン -->
                            <button class="change-reservation-button" data-reservation-id="{{ $reservation->id }}">予約変更</button>
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <p>ショップ：{{ $reservation->shop->name }}</p>
                        <p>日付：{{ $reservation->shop_date }}</p>
                        <p>時間：{{ $reservation->shop_time }}</p>
                        <p>人数：{{ $reservation->number_of_guests }}人</p>
                    </div>
                    <!-- 予約変更フォーム -->
                    <form class="change-reservation-form" data-reservation-id="{{ $reservation->id }}" action="{{ route('reservations.update', ['reservation' => $reservation->id]) }}" method="post" style="display: none;">
                        @csrf
                        @method('PUT')
                        <label for="new-date">新しい日付:</label>
                        <input type="date" id="new-date" name="new_date" required>

                        <label for="new-time">新しい時間:</label>
                        <input type="time" id="new-time" name="new_time" required>

                        <label for="new-guests">新しい人数:</label>
                        <input type="number" id="new-guests" name="new_guests" required>

                        <button type="submit">変更</button>
                    </form>
                </div>
            @endforeach
        @else
            <p>予約がありません。</p>
        @endif
    </div>
        <!-- お気に入り店舗の表示 -->
        <div class="col-md-6" style="width: 50%; padding-left: 20px;">
            <h4>{{ $userInfo->name }}さん</h4>
            <h4>お気に入り店舗</h4>
            @if($favoriteShops->isNotEmpty())
                <div class="shop-list" style="display: flex; flex-wrap: wrap;">
                    @foreach($favoriteShops as $favoriteShop)
                        @php
                            $shop = $favoriteShop->shop;
                        @endphp
                        <div class="shop-item" id="favorite-{{ $favoriteShop->id }}" style="width: 45%;">
                            @if($shop)
                                @if($shop->image_url)
                                    <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
                                @else
                                    <p>画像なし</p>
                                @endif
                                <div class="shop-details">
                                    @if($shop->name)
                                        <h2>{{ $shop->name }}</h2>
                                    @else
                                        <p>店舗名なし</p>
                                    @endif
                                    <div class="area-genre">
                                        @if($shop->region)
                                            <p># {{ $shop->region }}</p>
                                        @else
                                            <p>店舗情報なし</p>
                                        @endif
                                        @if($shop->genre)
                                            <p># {{ $shop->genre }}</p>
                                        @else
                                            <p>店舗情報なし</p>
                                        @endif
                                    </div>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <a href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}" style="text-decoration: none;">
                                            <button class="button-class">詳しくみる</button>
                                        </a>
                                        <a href="#" class="favorite-button" data-shop-id="{{ $shop->id }}" onclick="deleteFavorite({{ $favoriteShop->id }})">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p>お気に入りの店舗はありません。</p>
            @endif
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // closeModal 関数の定義
    function closeModal() {
        // モーダルを非表示
        $("#modal-overlay").hide();
        $("#modal").hide();

        // ハンバーガーアイコンと×アイコンを切り替える
        $(".menu-btn span").toggleClass("open");
    }

    $(document).ready(function () {
        // メニュートグルボタンのクリックイベント
        $("#menu-toggle").click(function () {
            $("#modal-overlay").toggle();
            $("#modal").toggle();
            $(".menu-btn span").toggleClass("open"); // ハンバーガーアイコンの表示切り替え
        });

        // バックホームボタンのクリックイベント
        $("#back-to-home").click(function () {
            closeModal();
        });

        // モーダルオーバーレイのクリックイベント
        $("#modal-overlay").click(function (event) {
            if (event.target.id === "modal-overlay") {
                closeModal();
            }
        });

        // 予約情報を変更するボタンのクリックイベント
        $('.change-reservation-button').click(function () {
            var reservationId = $(this).data('reservation-id');
            var form = $(".change-reservation-form[data-reservation-id='" + reservationId + "']");

            // 予約情報の変更フォームを表示
            form.show();
        });

        // 予約情報を変更するボタンがクリックされたときの処理
        $(".change-reservation-form button[type='submit']").click(function (event) {
            // フォームがサブミットされるのを防ぐ
            event.preventDefault();

            // 対象のフォームを取得
            var form = $(this).closest(".change-reservation-form");

            // Ajaxリクエストを使ってフォームをサブミット
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // 成功したらマイページにリダイレクト
                    window.location.href = "/mypage";
                },
                error: function (error) {
                    console.log('予約変更エラー:', error.responseText);
                }
            });

            // 予約情報の変更フォームを非表示
            form.hide();
        });
    });
</script>
</body>
</html>