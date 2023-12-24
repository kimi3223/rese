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
                        <!-- ログインしていない場合のみ表示 -->
                        @guest
                            <li class="nav-item active before-login">
                                <a class="nav-link" href="/register">Register <span class="sr-only"></span></a>
                            </li>
                        @endguest
                        <!-- ここまで -->
                        <!-- ログインしていない場合のみ表示 -->
                        @guest
                            <li class="nav-item active before-login">
                                <a class="nav-link" href="/login">Login <span class="sr-only"></span></a>
                            </li>
                        @endguest
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
<!-- 左半分 - 予約状況 -->
<div style="width: 50%; padding-right: 20px;">
    <h3>予約状況</h3>

    @if($reservations)
        <!-- 予約1のカード（サンプルデータ） -->
        <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 10px; background: rgb(0, 89, 255); color: white;">
            <div style="flex: 1;">
                <h4>予約1</h4>
                <p>shop: サンプル店舗</p>
                <p>Date: 2023-12-01</p>
                <p>Time: 18:00</p>
                <p>Number: 2人</p>
            </div>

            <!-- 予約を取り消すボタン -->
            @foreach($reservations as $reservation)
                <form method="POST" action="{{ url('reservations/' . $reservation->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">×</button>
                </form>
            @endforeach
        </div>
    @else
        <p>予約がありません。</p>
    @endif
</div>

<!-- 右半分：お気に入り店舗 -->
<div class="col-md-6">
    <h4>{{ $userInfo->name }}さん</h4>
    <h4>お気に入り店舗</h4>

    @if($favoriteShops->isNotEmpty())
        <div class="shop-list">
            @foreach($favoriteShops as $favoriteShop)
                <div class="shop-item" id="favorite-{{ $favoriteShop->id }}">
                    <!-- 関連するShopモデルを取得 -->
                    @php
                        $shop = $favoriteShop->shop->first();
                    @endphp

                    @if($shop)
                        <!-- 以下、店舗情報を表示するコードを追加 -->
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
                                <!-- 詳しく見るボタン -->
                                <a href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}" style="text-decoration: none;">
                                    <button class="button-class">詳しくみる</button>
                                </a>
                                <!-- お気に入りボタン -->
                                <a href="#" class="favorite-button" data-shop-id="{{ $shop->id }}" onclick="deleteFavorite({{ $favoriteShop->id }})">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ここまで -->
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>お気に入りの店舗はありません。</p>
    @endif
</div>
<script>
    function cancelReservation(reservationId) {
    if (confirm('本当に予約を取り消しますか？')) {
        // Ajaxリクエストを送信
        $.ajax({
            url: '/reservations/' + reservationId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                // 成功時の処理
                if (response.success) {
                    alert('予約が取り消されました。');
                    // ページをリロードするか、予約を表示するための別の処理を実行
                } else {
                    alert('予約の取り消しに失敗しました。');
                }
            },
            error: function(error) {
                // エラー時の処理
                alert('エラーが発生しました。');
            },
        });
    }
}
</script>
<script>
    function deleteFavorite(favoriteId) {
    console.log('Favorite ID:', favoriteId);
        if (confirm('本当にお気に入りを削除しますか？')) {
            // Ajaxリクエストを送信
            $.ajax({
                url: '/favorites/' + favoriteId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    // 成功時の処理
                    if (response.success) {
                        alert('お気に入りが削除されました。');
                        // ページをリロードするか、お気に入りを表示するための別の処理を実行
                    } else {
                        alert('お気に入りの削除に失敗しました。');
                    }
                },
                error: function(error) {
                    // エラー時の処理
                    alert('エラーが発生しました。');
                },
            });
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // お気に入り削除リンクがクリックされたときの処理
        document.querySelectorAll('.delete-favorite-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                var favoriteId = this.getAttribute('data-favorite-id');
                deleteFavorite(favoriteId);
            });
        });
    });
</script>
</body>
</html>
