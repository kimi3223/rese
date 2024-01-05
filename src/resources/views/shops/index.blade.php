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
                        <a href="/" class="favorite-button" data-shop-id="{{ $shop->id }}" style="color: {{ $heartColor }};">
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    $('.favorite-button').on('click', function (e) {
        e.preventDefault();

        var shopId = $(this).data('shop-id');
        var url = '/favorite/' + shopId;

        $.ajax({
            type: 'POST',
            url: url,
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data.status === 'added') {
                    // お気に入りに追加された場合のUIの更新（ハートの色を変更など）
                    $(e.target).css('color', 'red');
                    // 必要に応じて追加のUIの更新
                } else if (data.status === 'removed') {
                    // お気に入りから削除された場合のUIの更新
                    $(e.target).css('color', 'black');
                    // 必要に応じて追加のUIの更新
                }
            },
            error: function (data) {
                console.log('エラー:', data);
            }
        });
    });
});
</script>
@endsection