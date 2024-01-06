@extends('layouts.app')

@section('content')

<div class="shop-list">
    @foreach($shops as $shop)
        <div class="shop-item">
            <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
            <div class="shop-details">
                <h2>{{ $shop->name }}</h2>
                <div class="area-genre">
                    <p># {{ $shop->region }}</p>
                    <p># {{ $shop->genre }}</p>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <!-- 詳しく見るボタン -->
                    <a href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}" style="text-decoration: none;">
                        <button class="button-class">詳しくみる</button>
                    </a>
                    <!-- お気に入りボタン -->
                    @auth
                        <?php
                            $isFavorite = in_array($shop->id, $favoriteShopIds);
                            $heartClass = $isFavorite ? 'fas' : 'far';
                            $heartColor = $isFavorite ? 'red' : 'black';
                        ?>
                        <a href="#" class="favorite-button" data-shop-id="{{ $shop->id }}" style="color: {{ $heartColor }};">
                            <i class="fa-heart {{ $heartClass }}"></i>
                        </a>
                    @else
                        <!-- ログアウト時のデフォルトアイコン（黒枠） -->
                        <a href="{{ route('login') }}" style="color: black;">
                            <i class="fa-heart far"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- JavaScriptの例（JQueryを使用） -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // お気に入りボタンのクリックイベント
        $('.favorite-button').click(function (e) {
            e.preventDefault();

            // ログイン状態を確認
            @auth
                var button = $(this);
                var shopId = button.data('shop-id');
                var heartIcon = button.find('i');

                // Ajaxを使用してお気に入りの追加をリクエスト
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('favoriteshop.store') }}',
                    type: 'POST',
                    data: {
                        shop_id: shopId,
                        _token: csrfToken
                    },
                    success: function (data) {
                        alert('お気に入りに追加しました！');

                        // ハートの色を変更
                        heartIcon.toggleClass('fas far');
                        var isFavorite = heartIcon.hasClass('fas');
                        var heartColor = isFavorite ? 'red' : 'black';

                        // ハートの色を変更
                        heartIcon.css('color', heartColor);

                        // クラスが 'fas' であれば 'far' に、 'far' であれば 'fas' に切り替え
                        button.toggleClass('is-favorite');

                        // ハートが赤い場合はベージュに変更し、それ以外はベージュから赤に変更
                        var buttonColor = isFavorite ? 'beige' : 'red';
                        button.css('background-color', buttonColor);
                    }
                });
            @else
                // ログインしていない場合はログイン画面にリダイレクト
                window.location.href = '{{ route('login') }}';
            @endauth
        });
    });
</script>

@endsection