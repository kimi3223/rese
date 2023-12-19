@extends('layouts.app')

@section('content')

<div style="display: flex;">

    <!-- 左半分 - 予約状況 -->
    <div style="width: 50%; padding-right: 20px;">
        <h3>予約状況</h3>

        @if($reservation)
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
            <form method="POST" action="{{ url('reservations/' . $reservation->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">×</button>
            </form>
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
                    <!-- $favoriteShopは単一のFavoriteShopモデルのインスタンス -->
                    @php
                        $shop = $favoriteShop->shop->first(); // 修正
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
                        <a href="#" class="delete-favorite-link" data-favorite-id="{{ $favoriteShop->id }}">
                            削除
                        </a>
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
@endsection