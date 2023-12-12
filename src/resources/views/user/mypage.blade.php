@extends('layouts.app')

@section('content')

<div style="display: flex;">

    <!-- 左半分 - 予約状況 -->
    <div style="width: 50%; padding-right: 20px;">
        <h3>予約状況</h3>

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
            <form method="POST" action="{{ url('reservations/' . $reservation ?? ''->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">×</button>
            </form>
        </div>
    </div>

    <!-- 右半分：お気に入り店舗 -->
    <div class="col-md-6">
        <h4>{{ $userInfo->name }}さん</h4>
        <h4>お気に入り店舗</h4>
        @if($favoriteShops->isEmpty())
            <p>お気に入りの店舗はありません。</p>
        @else
            <div class="shop-list">
                @foreach($favoriteShops as $favorite)
                    <div class="shop-item">
                        <img src="{{ $favorite->shop->image_url }}" alt="{{ $favorite->shop->name }}">
                        <div class="shop-details">
                            <h2>{{ $favorite->shop->name }}</h2>
                            <div class="area-genre">
                                <p># {{ $favorite->shop->region }}</p>
                                <p># {{ $favorite->shop->genre }}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <!-- 詳しく見るボタン -->
                                <a href="{{ route('shops.show', $favorite->shop->id) }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-primary">詳しくみる</button>
                                </a>
                                <!-- お気に入りボタン -->
                                <a href="#" class="favorite-button" data-shop-id="{{ $favorite->shop->id }}" onclick="deleteFavorite({{ $favorite->id }})">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
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

@endsection