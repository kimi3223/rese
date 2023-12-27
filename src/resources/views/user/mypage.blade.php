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
                    <a id="back-to-home" onclick="closeModal()">×</a>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
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

            function closeModal() {
                $("#modal-overlay").hide();
                $("#modal").hide();
                $(".menu-btn span").toggleClass("open");
            }
        });
    </script>

    <div style="display: flex;">
        <div style="width: 50%; padding-right: 20px;">
            <h3>予約状況</h3>
            @if($reservations)
                @foreach($reservations as $reservation)
                    <div style="display: flex; align-items: center; border: 1px solid #ccc; padding: 10px; background: rgb(0, 89, 255); color: white;">
                        <div style="flex: 1;">
                            <h4>{{ $reservation->name }}</h4>
                            <p>shop {{ $reservation->shop->name }}</p>
                            <p>Date {{ $reservation->shop_date }}</p>
                            <p>Time {{ $reservation->shop_time }}</p>
                            <p>Number {{ $reservation->number_of_guests }}人</p>
                        </div>
                        <form method="POST" action="{{ route('reservations.destroy', ['reservationId' => $reservation->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">×</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>予約がありません。</p>
            @endif
        </div>

        <div class="col-md-6">
            <h4>{{ $userInfo->name }}さん</h4>
            <h4>お気に入り店舗</h4>
            @if($favoriteShops->isNotEmpty())
                <div class="shop-list">
                    @foreach($favoriteShops as $favoriteShop)
                        <div class="shop-item" id="favorite-{{ $favoriteShop->id }}">
                            @php
                                $shop = $favoriteShop->shop->first();
                            @endphp
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

    <script>
        function deleteFavorite(favoriteId) {
            if (confirm('本当にお気に入りを削除しますか？')) {
                $.ajax({
                    url: '{{ route("favoriteshop.destroy", ["favorite" => ":favoriteId"]) }}'.replace(':favoriteId', favoriteId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response                ) {
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
</body>
</html>